import type Alpine from "alpinejs";

type FormFieldConfig = {
  fieldLanguage: string;
  livewireField: string | null;
  livewireTranslatable: boolean;
  translationValues: Record<string, unknown>;
};

type FormFieldWire = {
  $set: (path: string, value: unknown, live?: boolean) => void;
};

type FormFieldState = FormFieldConfig & {
  $root?: HTMLElement;
  $wire?: FormFieldWire;
  syncLivewire: (value: unknown) => void;
  syncLivewireEvent: (event: Event) => void;
  syncLivewireCollection: () => void;
};

function createFieldContainer(
  part: string | null,
): Record<string, unknown> | unknown[] {
  if (part === null || /^\d+$/.test(part)) {
    return [];
  }

  return {};
}

function setNestedFieldValue(
  container: Record<string, unknown> | unknown[],
  parts: Array<string | null>,
  value: unknown,
): void {
  let current = container;

  for (let index = 0; index < parts.length; index++) {
    const part = parts[index];
    const isLast = index === parts.length - 1;
    const resolvedPart =
      part ??
      (Array.isArray(current)
        ? String(current.length)
        : String(Object.keys(current).length));
    const arrayIndex = Array.isArray(current) ? Number(resolvedPart) : -1;

    if (Array.isArray(current) && !Number.isInteger(arrayIndex)) {
      return;
    }

    if (isLast) {
      if (Array.isArray(current)) {
        if (part === null) {
          current.push(value);
        } else {
          current[arrayIndex] = value;
        }
      } else {
        current[resolvedPart] = value;
      }

      return;
    }

    const child = Array.isArray(current)
      ? current[arrayIndex]
      : current[resolvedPart];

    if (
      child === null ||
      typeof child !== "object" ||
      (!Array.isArray(child) && !Object.keys(child).length)
    ) {
      const nextContainer = createFieldContainer(parts[index + 1]);

      if (Array.isArray(current)) {
        current[arrayIndex] = nextContainer;
      } else {
        current[resolvedPart] = nextContainer;
      }

      current = nextContainer;
    } else {
      current = child as Record<string, unknown> | unknown[];
    }
  }
}

export default function registerAlpineFormField(alpine: typeof Alpine): void {
  alpine.data("narsilFormField", (config: FormFieldConfig): FormFieldState => ({
    ...config,
    syncLivewire(value: unknown): void {
      const root = this.$root?.closest<HTMLElement>(
        "[data-livewire-form-prefix]",
      );

      if (!root || !this.$wire || !this.livewireField) {
        return;
      }

      let field = this.$root?.dataset.livewireField ?? this.livewireField;

      if (this.livewireTranslatable) {
        field += `.${this.fieldLanguage}`;
      }

      this.$wire.$set(
        `${root.dataset.livewireFormPrefix}.${field}`,
        value,
        true,
      );
    },
    syncLivewireEvent(event: Event): void {
      const target = event.target;
      let value: unknown;

      if (event.type === "narsil-sortable-change") {
        this.syncLivewireCollection();

        return;
      }

      if (
        event.type === "narsil-checkbox-change" ||
        event.type === "narsil-checkboxes-change"
      ) {
        if (!(target instanceof Element)) {
          return;
        }

        const fieldRoot = target.closest('[data-slot="field-root"]');

        if (fieldRoot !== this.$root) {
          return;
        }

        if (
          event.type === "narsil-checkbox-change" &&
          target.closest('[data-slot="checkboxes-root"]')
        ) {
          return;
        }

        value = (event as CustomEvent<{ value?: unknown }>).detail?.value;
      } else if (
        event.type === "combobox-change" ||
        event.type === "rich-text-change"
      ) {
        value = (event as CustomEvent<{ value?: unknown }>).detail?.value;
      } else if (
        target instanceof HTMLInputElement ||
        target instanceof HTMLSelectElement ||
        target instanceof HTMLTextAreaElement
      ) {
        if (target instanceof HTMLInputElement && target.type === "file") {
          return;
        }

        if (target instanceof HTMLInputElement && target.type === "checkbox") {
          const checkboxes = this.$root?.querySelectorAll<HTMLInputElement>(
            'input[type="checkbox"]',
          );

          if (checkboxes && checkboxes.length > 1) {
            value = Array.from(checkboxes)
              .filter((input) => input.checked)
              .map((input) => input.value);
          } else {
            value = target.checked;
          }
        } else if (
          target instanceof HTMLInputElement &&
          target.type === "radio"
        ) {
          value =
            this.$root?.querySelector<HTMLInputElement>(
              'input[type="radio"]:checked',
            )?.value ?? "";
        } else {
          value = target.value;
        }
      } else {
        return;
      }

      this.syncLivewire(value);
    },
    syncLivewireCollection(): void {
      const root = this.$root;
      const field = root?.dataset.livewireField ?? this.livewireField;
      const prefix = root?.closest<HTMLElement>("[data-livewire-form-prefix]")
        ?.dataset.livewireFormPrefix;
      const wire = this.$wire;

      if (!root || !prefix || !field || !wire) {
        return;
      }

      const fieldName = field
        .split(".")
        .map((part, index) => (index === 0 ? part : `[${part}]`))
        .join("");
      const value: unknown[] = [];
      const controls = root.querySelectorAll<
        HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement
      >("input[name], select[name], textarea[name]");

      controls.forEach((control) => {
        const name = control.name;

        if (name !== fieldName && !name.startsWith(`${fieldName}[`)) {
          return;
        }

        let controlValue: unknown;

        if (control instanceof HTMLInputElement) {
          if (
            control.type === "file" ||
            control.type === "button" ||
            control.type === "submit"
          ) {
            return;
          }

          if (control.type === "radio") {
            if (!control.checked) {
              return;
            }

            controlValue = control.value;
          } else if (control.type === "checkbox") {
            controlValue = control.checked;
          } else if (control.disabled) {
            const checkboxRoot = control.closest('[data-slot="checkbox-root"]');

            if (
              control.type !== "hidden" ||
              !checkboxRoot ||
              checkboxRoot.closest('[data-slot="checkboxes-root"]')
            ) {
              return;
            }

            controlValue = false;
          } else {
            controlValue = control.value;
          }
        } else if (control instanceof HTMLSelectElement && control.multiple) {
          controlValue = Array.from(control.selectedOptions).map(
            (option) => option.value,
          );
        } else {
          controlValue = control.value;
        }

        const parts = Array.from(
          name.slice(fieldName.length).matchAll(/\[([^\]]*)\]/g),
        ).map((match) => (match[1] === "" ? null : match[1]));

        if (parts.length > 0) {
          setNestedFieldValue(value, parts, controlValue);
        }
      });

      this.syncLivewire(value);
    },
  }));
}

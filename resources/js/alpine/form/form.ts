import type Alpine from "alpinejs";

type FormReloadDetail = {
  form?: HTMLElement;
  id?: string;
  value?: string | string[];
};

type FormState = {
  formDirty: boolean;
  loading: boolean;
  controller: AbortController | null;
  $root?: HTMLElement;
  reload: (detail: FormReloadDetail) => Promise<void>;
};

type AlpineWithMorph = typeof Alpine & {
  $data: (element: HTMLElement) => { value?: string | string[] };
  morph?: (from: HTMLElement, to: HTMLElement) => void;
};

export default function registerAlpineForm(alpine: typeof Alpine): void {
  alpine.data("narsilForm", (): FormState => ({
    formDirty: false,
    loading: false,
    controller: null,

    async reload(detail: FormReloadDetail): Promise<void> {
      if (!detail.form || !detail.id || detail.value === undefined) {
        return;
      }

      const source = this.$root?.dataset.formSource;
      const url = new URL(source ?? window.location.href);
      const value = Array.isArray(detail.value)
        ? detail.value
        : String(detail.value);

      if (Array.isArray(value)) {
        url.searchParams.delete(detail.id);
        value.forEach((item) =>
          url.searchParams.append(detail.id as string, item),
        );
      } else {
        url.searchParams.set(detail.id, value);
      }

      this.controller?.abort();
      const controller = new AbortController();
      this.controller = controller;
      this.loading = true;

      try {
        const response = await fetch(url, {
          headers: {
            Accept: "text/html",
            "X-Narsil-Form-Reload": "true",
            "X-Requested-With": "XMLHttpRequest",
            ...(source ? { "X-Narsil-Modal": "true" } : {}),
          },
          signal: controller.signal,
        });

        if (!response.ok) {
          throw new Error(`Failed to reload form (${response.status}).`);
        }

        const parsedDocument = new DOMParser().parseFromString(
          await response.text(),
          "text/html",
        );
        const nextForm =
          parsedDocument.querySelector<HTMLElement>("[data-form-root]");
        const currentForm = this.$root;
        const morph = (window as Window & { Alpine?: AlpineWithMorph }).Alpine
          ?.morph;

        if (!nextForm || !currentForm || !morph) {
          throw new Error("Unable to morph the reloaded form.");
        }

        morph(currentForm, nextForm);

        const resolvedForm = currentForm.isConnected
          ? currentForm
          : Array.from(
              window.document.querySelectorAll<HTMLElement>("[data-form-root]"),
            ).find((element) => element.id === currentForm.id);
        const alpine = (window as Window & { Alpine?: AlpineWithMorph }).Alpine;

        requestAnimationFrame(() => {
          const reloadedCombobox = Array.from(
            resolvedForm?.querySelectorAll<HTMLElement>(
              "[data-form-reload-id]",
            ) ?? [],
          ).find((element) => element.dataset.formReloadId === detail.id);

          if (reloadedCombobox && alpine) {
            alpine.$data(reloadedCombobox).value = value;
          }
        });
      } catch (error) {
        if (!(error instanceof DOMException && error.name === "AbortError")) {
          console.error(error);
        }
      } finally {
        if (this.controller === controller) {
          this.controller = null;
          this.loading = false;
        }
      }
    },
  }));
}

import type Alpine from "alpinejs";
import sortable from "./sortable-controller";

type SortableListConfig = {
  itemsRef: string;
  itemSelector: string;
  templateSelector: string;
  indexToken: string;
  uuidToken: string;
  prefix: string;
  idPrefix?: string;
  placeholderSelector?: string;
  keepEmptyContainer?: boolean;
};

const builderPathAttributes = new Set([
  "data-livewire-field",
  "name",
  "id",
  "for",
  "data-builder-name",
  "data-builder-path",
  "data-form-reload-id",
  "key",
  "x-data",
]);

function escapeRegExp(value: string): string {
  return value.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}

function rebaseBuilderPaths(
  root: ParentNode,
  oldName: string,
  newName: string,
  oldId: string,
  newId: string,
): void {
  const idPattern = new RegExp(`${escapeRegExp(oldId)}(?=\\.|$|[^0-9])`, "g");
  const elements = Array.from(root.querySelectorAll("*"));

  if (root instanceof Element) {
    elements.unshift(root);
  }

  elements.forEach((element) => {
    Array.from(element.attributes).forEach((attribute) => {
      if (
        builderPathAttributes.has(attribute.name) ||
        attribute.name.startsWith("aria-")
      ) {
        attribute.value = attribute.value
          .replaceAll(oldName, newName)
          .replace(idPattern, newId);
      }
    });
  });

  root.querySelectorAll("template").forEach((template) => {
    rebaseBuilderPaths(template.content, oldName, newName, oldId, newId);
  });
}

export default function registerSortableList(alpine: typeof Alpine): void {
  alpine.data("narsilSortableList", (config: SortableListConfig) => ({
    ...sortable(config),
    initialized: false,
    add(blockId?: string, placeholderId?: string): void {
      let templateSelector = config.templateSelector;

      if (blockId) {
        templateSelector = `template[data-builder-template="${blockId}"]`;
      }

      const template =
        this.$root.querySelector<HTMLTemplateElement>(templateSelector);

      if (!template) {
        return;
      }

      const fragment = template.content.cloneNode(true) as DocumentFragment;
      const item = fragment.firstElementChild;

      if (!item) {
        return;
      }

      let items = this.getItemsContainer();

      if (!items) {
        items = document.createElement("div");
        items.className = "grid gap-4";
        items.setAttribute("x-ref", config.itemsRef);
        items.setAttribute("x-sort", "sync()");
        template.before(items);
        alpine.initTree(items as Alpine.ElementWithXAttributes);
      }

      const index = items.querySelectorAll(config.itemSelector).length;
      const uuid = crypto.randomUUID();

      this.replaceTemplateValues(item, index, uuid);

      let placeholder: HTMLElement | null = null;

      if (placeholderId) {
        const placeholders = items.querySelectorAll<HTMLElement>(
          ":scope > [data-builder-placeholder]",
        );

        for (const element of placeholders) {
          if (element.dataset.builderPlaceholder === placeholderId) {
            placeholder = element;
            break;
          }
        }
      } else {
        placeholder = items.querySelector<HTMLElement>(
          config.placeholderSelector ?? ":scope > [data-builder-tail]",
        );
      }

      if (placeholder) {
        placeholder.before(item);
      } else {
        items.appendChild(item);
      }

      if (
        placeholder?.hasAttribute("data-builder-placeholder") ||
        placeholder?.hasAttribute("data-builder-tail")
      ) {
        const addControl = placeholder.cloneNode(true) as HTMLElement;

        addControl.removeAttribute("data-builder-tail");
        addControl.setAttribute("data-builder-placeholder", uuid);
        addControl.dataset.builderConnectBelow = "true";
        addControl.classList.remove("not-first:mt-2");
        addControl.classList.add("mb-2");
        this.updateBuilderPlaceholder(addControl, uuid);
        item.before(addControl);
        alpine.initTree(addControl as Alpine.ElementWithXAttributes);
      }

      alpine.initTree(item as Alpine.ElementWithXAttributes);
      this.sync();
    },
    init(): void {
      this.sync();
      this.initialized = true;
    },
    reindex(): void {
      if (config.keepEmptyContainer) {
        const prefix =
          this.$root.getAttribute("data-builder-name") ?? config.prefix;
        const idPrefix =
          this.$root.getAttribute("data-builder-path") ?? config.idPrefix ?? "";
        const namePattern = new RegExp(`^${escapeRegExp(prefix)}\\[(\\d+)\\]`);

        this.getRows().forEach((item, index) => {
          const name = item
            .querySelector<HTMLInputElement>('input[name$="[uuid]"]')
            ?.getAttribute("name");
          const previous = name?.match(namePattern)?.[1];

          if (previous === undefined || Number(previous) === index) {
            return;
          }

          rebaseBuilderPaths(
            item,
            `${prefix}[${previous}]`,
            `${prefix}[${index}]`,
            `${idPrefix}.${previous}`,
            `${idPrefix}.${index}`,
          );
        });

        return;
      }

      const escapedPrefix = config.prefix.replace(
        /[.*+?^${}()|[\]\\]/g,
        "\\$&",
      );
      const namePattern = new RegExp(`^${escapedPrefix}\\[\\d+\\]`);
      const idPattern = config.idPrefix
        ? new RegExp(
            `^${config.idPrefix.replace(/[.*+?^${}()|[\]\\]/g, "\\$&")}\\.\\d+`,
          )
        : /\.\d+(?=\.|$)/;

      this.getRows().forEach((item, index) => {
        item.querySelectorAll("[name]").forEach((input) => {
          input.setAttribute(
            "name",
            (input.getAttribute("name") ?? "").replace(
              namePattern,
              `${config.prefix}[${index}]`,
            ),
          );
        });
        item
          .querySelectorAll("[id], [for], [data-livewire-field]")
          .forEach((element) => {
            for (const attribute of ["id", "for", "data-livewire-field"]) {
              const value = element.getAttribute(attribute);

              if (value) {
                element.setAttribute(
                  attribute,
                  value.replace(idPattern, `${config.idPrefix ?? ""}.${index}`),
                );
              }
            }
          });
      });
    },
    remove(item: Element): void {
      const items = this.getItemsContainer();

      if (config.keepEmptyContainer && items) {
        const itemId = this.getRowId(item);
        const placeholders = items.querySelectorAll<HTMLElement>(
          ":scope > [data-builder-placeholder]",
        );

        for (const placeholder of placeholders) {
          if (placeholder.dataset.builderPlaceholder === itemId) {
            placeholder.remove();
            break;
          }
        }
      }

      item.remove();
      this.sync();

      if (
        items &&
        !config.keepEmptyContainer &&
        items.querySelector(config.itemSelector) === null
      ) {
        items.remove();
      }
    },
    removeById(id: string): void {
      const item = this.getRows().find(
        (candidate) => candidate.getAttribute("data-sortable-item") === id,
      );

      if (item) {
        this.remove(item);
      }
    },
    replaceTemplateValues(root: ParentNode, index: number, uuid: string): void {
      const nodes = Array.from(root.querySelectorAll("*"));

      if (root instanceof Element) {
        nodes.unshift(root);
      }

      nodes.forEach((node) => {
        Array.from(node.attributes).forEach((attribute) => {
          attribute.value = attribute.value
            .replaceAll(config.indexToken, String(index))
            .replaceAll(config.uuidToken, uuid);
        });
      });

      root.querySelectorAll("template").forEach((template) => {
        this.replaceTemplateValues(template.content, index, uuid);
      });
    },
    sync(): void {
      this.syncOrder();
      this.reindex();
      this.syncBuilderPlaceholders();

      if (this.initialized) {
        this.$root.dispatchEvent(
          new CustomEvent("narsil-sortable-change", { bubbles: true }),
        );
      }
    },
    syncBuilderPlaceholders(): void {
      if (!config.keepEmptyContainer) {
        return;
      }

      const items = this.getItemsContainer();

      if (!items) {
        return;
      }

      const rows = this.getRows();
      const placeholders = Array.from(
        items.querySelectorAll<HTMLElement>(
          ":scope > [data-builder-placeholder]",
        ),
      );

      rows.forEach((row, index) => {
        const placeholder = placeholders[index];

        if (!placeholder) {
          return;
        }

        row.before(placeholder);

        const itemId = this.getRowId(row);

        placeholder.dataset.builderPlaceholder = itemId;
        placeholder.dataset.builderConnectAbove = String(index > 0);
        placeholder.classList.toggle("mt-2", index > 0);
        this.updateBuilderPlaceholder(placeholder, itemId);
      });

      placeholders.slice(rows.length).forEach((placeholder) => {
        placeholder.remove();
      });

      const tail = items.querySelector<HTMLElement>(
        ":scope > [data-builder-tail]",
      );

      if (tail) {
        tail.classList.toggle("not-first:mt-2", rows.length > 0);
        tail.dataset.builderConnectAbove = String(rows.length > 0);
        tail.dataset.builderConnectBelow = "false";
        items.append(tail);
      }
    },
    updateBuilderPlaceholder(root: ParentNode, itemId: string): void {
      root
        .querySelectorAll<HTMLElement>("[data-builder-block-id]")
        .forEach((element) => {
          element.dataset.builderPlaceholderId = itemId;
        });
      root
        .querySelectorAll<HTMLTemplateElement>("template")
        .forEach((template) => {
          this.updateBuilderPlaceholder(template.content, itemId);
        });
    },
  }));
}

import type Alpine from "alpinejs";
import sortable from "./sortable";

type SortableInputConfig = {
  itemsRef: string;
  itemSelector: string;
  templateSelector: string;
  indexToken: string;
  uuidToken: string;
  prefix: string;
  idPrefix?: string;
  placeholderSelector?: string;
};

export default function registerSortableInput(alpine: typeof Alpine): void {
  alpine.data("narsilSortableInput", (config: SortableInputConfig) => ({
    ...sortable(config),
    init(): void {
      this.sync();
    },
    sync(): void {
      this.syncOrder();
      this.reindex();
    },
    reindex(): void {
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
        item.querySelectorAll("[id]").forEach((input) => {
          input.id = input.id.replace(
            idPattern,
            `${config.idPrefix ?? ""}.${index}`,
          );
        });
      });
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
    add(): void {
      const template = this.$root.querySelector<HTMLTemplateElement>(
        config.templateSelector,
      );

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

      const placeholder = config.placeholderSelector
        ? items.querySelector(config.placeholderSelector)
        : null;

      if (placeholder) {
        placeholder.before(item);
      } else {
        items.appendChild(item);
      }

      alpine.initTree(item as Alpine.ElementWithXAttributes);
      this.sync();
    },
    remove(item: Element): void {
      const items = this.getItemsContainer();

      item.remove();
      this.sync();

      if (items && items.querySelector(config.itemSelector) === null) {
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
  }));
}

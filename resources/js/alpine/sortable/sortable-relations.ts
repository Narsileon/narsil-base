import type Alpine from "alpinejs";
import sortable from "./sortable-controller";

type SortEvent = {
  from: HTMLElement;
  item: HTMLElement;
  newDraggableIndex: number;
  to: HTMLElement;
};

type RelationWire = {
  reorder(path: string, order: string[]): Promise<void>;
  transfer(from: string, to: string, uuid: string, position: number): Promise<void>;
};

function getWire(context: unknown): RelationWire {
  return (context as { $wire: RelationWire }).$wire;
}

export default function registerSortableRelations(alpine: typeof Alpine): void {
  alpine.data("narsilSortableRelations", function () {
    let snapshots = new Map<HTMLElement, Node[]>();
    let cancelled = false;
    let baseline: Node[] = [];

    function cancel(event: KeyboardEvent): void {
      if (event.key === "Escape" && snapshots.size) {
        cancelled = true;
      }
    }

    function restore(): void {
      alpine.mutateDom(function () {
        snapshots.forEach(function (children, container) {
          children.forEach(function (child) {
            container.append(child);
          });
        });
      });

      snapshots.clear();
    }

    return {
      ...sortable({ itemsRef: "items", itemSelector: ":scope > [data-relation-item]" }),
      init() {
        this.syncOrder();
        baseline = Array.from(this.getItemsRoot().childNodes);
        this.$watch("$wire.items", () => {
          this.$nextTick(() => {
            this.syncOrder();
            baseline = Array.from(this.getItemsRoot().childNodes);
          });
        });
        document.addEventListener("keydown", cancel);
      },
      destroy() {
        document.removeEventListener("keydown", cancel);
      },
      async sync() {
        const order = this.getRows().map((row: HTMLElement) => this.getRowId(row));
        const root = this.getItemsRoot();
        const wire = getWire(this);

        alpine.mutateDom(function () {
          baseline.forEach(function (child) { root.append(child); });
        });
        await wire.reorder(root.dataset.relationPath ?? "", order);
        this.syncOrder();
      },
      sortOptions() {
        const controller = this;
        const root = this.getItemsRoot();

        return {
          draggable: "> [data-relation-item]",
          filter(event: Event) {
            const target = event.target as HTMLElement;

            return target.closest("[data-relation-item]")?.parentElement !== root;
          },
          onStart() {
            cancelled = false;
            const component = root.closest("[wire\\:id]");

            component?.querySelectorAll<HTMLElement>("[x-sort]").forEach(function (container) {
              snapshots.set(container, Array.from(container.childNodes));
            });
          },
          async onEnd(event: SortEvent) {
            const order = Array.from(event.to.querySelectorAll<HTMLElement>(":scope > [data-relation-item]"))
              .map(function (row) { return row.dataset.sortableItem ?? ""; });
            const wire = getWire(controller);
            const from = event.from.dataset.relationPath ?? "";
            const to = event.to.dataset.relationPath ?? "";

            restore();

            if (!cancelled) {
              if (event.from === event.to) {
                await wire.reorder(from, order);
              } else {
                await wire.transfer(from, to, event.item.dataset.sortableItem ?? "", event.newDraggableIndex);
              }
            }

            controller.syncOrder();
          },
        };
      },
    };
  });
}

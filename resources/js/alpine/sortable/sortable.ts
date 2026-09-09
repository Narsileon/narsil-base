import type Alpine from "alpinejs";

export type SortableConfig = {
  itemsRef: string;
  itemSelector: string;
  idAttribute?: string;
};

type SortableController = {
  order: string[];
  getItemsContainer(): HTMLElement | null;
  getItemsRoot(): HTMLElement;
  getRows(): HTMLElement[];
  getRowId(row: Element): string;
  getMoveIds(id: string | number): string[];
  moveById(id: string | number, direction: number): void;
  restoreOrder(order: string[]): void;
  sync(): void;
  syncOrder(): void;
};

export default function sortable(
  config: SortableConfig,
): Alpine.AlpineComponent<SortableController> {
  return {
    order: [],
    getItemsContainer() {
      const reference = this.$refs[config.itemsRef] as HTMLElement | undefined;

      return (
        reference ??
        this.$root.querySelector<HTMLElement>(`[x-ref="${config.itemsRef}"]`) ??
        null
      );
    },
    getItemsRoot() {
      return this.getItemsContainer() ?? this.$root;
    },
    getRows() {
      return Array.from(
        this.getItemsRoot().querySelectorAll<HTMLElement>(config.itemSelector),
      ).filter((row) => {
        return !row.classList.contains("sortable-fallback");
      });
    },
    getRowId(row) {
      return row.getAttribute(config.idAttribute ?? "data-sortable-item") ?? "";
    },
    getMoveIds(_id) {
      return this.order;
    },
    moveById(id, direction) {
      const rows = this.getRows();
      const ids = this.getMoveIds(id);
      const index = ids.indexOf(String(id));
      const next = index + direction;

      if (index >= 0 && next >= 0 && next < ids.length) {
        const item = rows.find((row) => this.getRowId(row) === String(id));
        const target = rows.find((row) => this.getRowId(row) === ids[next]);

        if (item && target) {
          if (direction < 0) {
            target.before(item);
          } else {
            target.after(item);
          }

          this.sync();
        }
      }
    },
    restoreOrder(order) {
      const container = this.getItemsRoot();
      const rows = new Map(
        this.getRows().map((row) => [this.getRowId(row), row]),
      );

      order.forEach((id) => {
        const row = rows.get(id);

        if (row) {
          container.append(row);
        }
      });
    },
    sync() {
      this.syncOrder();
    },
    syncOrder() {
      this.order = this.getRows().map((row) => this.getRowId(row));
    },
  };
}

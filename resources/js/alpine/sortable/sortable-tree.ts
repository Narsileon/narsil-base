import type Alpine from "alpinejs";
import sortable from "./sortable";

type TreeId = string | number;
type TreeLabel = string | Record<string, string>;
type TreeItem = {
  id: TreeId;
  parent_id: TreeId | null;
  depth: number;
};
type TreeProjection = {
  depth: number;
  parentId: TreeId | null;
};
type TreeSortEvent = {
  item: HTMLElement;
  originalEvent?: Event;
  related?: HTMLElement;
  willInsertAfter?: boolean;
};
type SortableTreeConfig = {
  formLanguage: string;
  items: TreeItem[];
  name: string;
  rootExclusive: boolean;
};

export default function registerSortableTree(alpine: typeof Alpine): void {
  alpine.data("narsilSortableTree", (config: SortableTreeConfig) => ({
    ...sortable({
      itemsRef: "items",
      itemSelector: ":scope > [data-tree-item]",
      idAttribute: "data-tree-item",
    }),
    deleteDialogOpen: false,
    deleteDialogUrl: "",
    formLanguage: config.formLanguage,
    items: config.items,
    name: config.name,
    order: config.items.map((item) => String(item.id)),
    activeDepth: 0,
    activeId: null as string | null,
    dragCanceled: false,
    dragOffset: 0,
    dragOrder: [] as string[],
    dragStartX: 0,
    dragCancelHandler: null as ((event: KeyboardEvent) => void) | null,
    dragMoveHandler: null as ((event: Event) => void) | null,
    projectedDepth: null as number | null,
    projectedParentId: null as TreeId | null,
    rootExclusive: config.rootExclusive,
    appendInputs(
      parentId: TreeId | null,
      fieldName: string,
      container: HTMLElement,
    ): void {
      const children = this.order
        .map((id) => this.getItem(id))
        .filter(
          (item): item is TreeItem =>
            !!item && String(item.parent_id ?? "") === String(parentId ?? ""),
        );

      children.forEach((item, index) => {
        const itemName = `${fieldName}[${index}]`;
        const input = document.createElement("input");
        input.name = `${itemName}[id]`;
        input.type = "hidden";
        input.value = String(item.id);
        container.appendChild(input);
        this.appendInputs(item.id, `${itemName}[children]`, container);
      });
    },
    getItem(id: unknown): TreeItem | undefined {
      return this.items.find((item) => String(item.id) === String(id));
    },
    getLabel(label?: TreeLabel): string {
      if (label && typeof label === "object") {
        return (
          label[this.formLanguage] ??
          label["en"] ??
          Object.values(label)[0] ??
          ""
        );
      }

      return label ?? "";
    },
    getSiblingIds(id: unknown): string[] {
      const item = this.getItem(id);

      if (!item) {
        return [];
      }

      return this.order.filter((orderId) => {
        const sibling = this.getItem(orderId);

        return (
          sibling &&
          String(sibling.parent_id ?? "") === String(item.parent_id ?? "")
        );
      });
    },
    getPointerX(event?: Event): number {
      const pointer = event as (MouseEvent & Partial<TouchEvent>) | undefined;
      const point =
        pointer?.touches?.[0] ?? pointer?.changedTouches?.[0] ?? pointer;

      return point?.clientX ?? 0;
    },
    getDragStartX(event: Event | undefined, item: HTMLElement): number {
      const pointerX = this.getPointerX(event);

      if (pointerX !== 0) {
        return pointerX;
      }

      const handle = item.querySelector("[x-sort\\:handle]");
      const bounds = (handle ?? item).getBoundingClientRect();

      return bounds.left + bounds.width / 2;
    },
    isDescendant(id: unknown, ancestorId: unknown): boolean {
      let item = this.getItem(id);

      while (item?.parent_id !== null && item?.parent_id !== undefined) {
        if (String(item.parent_id) === String(ancestorId)) {
          return true;
        }

        item = this.getItem(item.parent_id);
      }

      return false;
    },
    normalizeProjection(projection: TreeProjection): TreeProjection {
      const parent = this.getItem(projection.parentId);

      if (
        parent &&
        String(parent.id) !== String(this.activeId) &&
        !this.isDescendant(parent.id, this.activeId)
      ) {
        projection.depth = (parent.depth ?? 0) + 1;

        return projection;
      }

      if (this.rootExclusive && this.activeDepth > 0) {
        const rootItem = this.items.find((item) => item.depth === 0);

        if (rootItem && String(rootItem.id) !== String(this.activeId)) {
          projection.depth = 1;
          projection.parentId = rootItem.id;

          return projection;
        }
      }

      projection.depth = 0;
      projection.parentId = null;

      return projection;
    },
    getItemDepth(id: unknown, fallback: number): number {
      if (
        this.activeId !== null &&
        String(id) === String(this.activeId) &&
        this.projectedDepth !== null
      ) {
        return this.projectedDepth;
      }

      return this.getItem(id)?.depth ?? fallback;
    },
    updateDragProjection(event?: Event): void {
      if (this.activeId !== null && !this.dragCanceled) {
        if (event) {
          this.dragOffset = this.getPointerX(event) - this.dragStartX;
        }

        const projection = this.getProjection();
        this.projectedDepth = projection.depth;
        this.projectedParentId = projection.parentId;
      }
    },
    getProjection(): TreeProjection {
      const reordered = this.getRows()
        .map((row) => String(row.dataset.treeItem))
        .filter((id) => !this.isDescendant(id, this.activeId));
      const projectedIndex = reordered.indexOf(String(this.activeId));
      const activeItem = this.getItem(this.activeId);
      const projection = {
        depth: this.activeDepth,
        parentId: activeItem?.parent_id ?? null,
      };

      if (projectedIndex < 0 || !activeItem) {
        return this.normalizeProjection(projection);
      }

      const reorderedPrevious = this.getItem(reordered[projectedIndex - 1]);
      const reorderedNext = this.getItem(reordered[projectedIndex + 1]);
      const dragDepth =
        Math.abs(this.dragOffset) < 16 ? 0 : Math.round(this.dragOffset / 20);
      const maxDepth = reorderedPrevious
        ? (reorderedPrevious.depth ?? 0) + 1
        : 0;
      const minDepth = reorderedNext ? (reorderedNext.depth ?? 0) : 0;

      projection.depth = this.activeDepth + dragDepth;

      const minimumDepth = this.rootExclusive ? 1 : 0;

      projection.depth = Math.min(
        maxDepth,
        Math.max(projection.depth, minDepth, minimumDepth),
      );
      projection.parentId = null;

      if (projection.depth === 0) {
        return this.normalizeProjection(projection);
      }

      if (!reorderedPrevious) {
        const rootItem = reordered
          .map((id) => this.getItem(id))
          .find((item) => item && item.depth === 0);

        projection.parentId = rootItem?.id ?? null;

        return this.normalizeProjection(projection);
      }

      if (projection.depth === reorderedPrevious.depth) {
        projection.parentId = reorderedPrevious.parent_id;
      } else if (projection.depth > reorderedPrevious.depth) {
        projection.parentId = reorderedPrevious.id;
      } else {
        const newParent = reordered
          .slice(0, projectedIndex)
          .reverse()
          .map((id) => this.getItem(id))
          .find((item) => item && item.depth === projection.depth);

        projection.parentId = newParent?.parent_id ?? null;
      }

      return this.normalizeProjection(projection);
    },
    getMoveIds(id: string | number): string[] {
      return this.getSiblingIds(id);
    },
    isCanceled(event: TreeSortEvent): boolean {
      const originalEvent = event?.originalEvent;

      return (
        this.dragCanceled ||
        ["pointercancel", "touchcancel"].includes(originalEvent?.type ?? "") ||
        (originalEvent?.type === "dragend" &&
          (originalEvent as DragEvent).dataTransfer?.dropEffect === "none")
      );
    },
    resetDrag(): void {
      if (this.dragCancelHandler) {
        document.removeEventListener("keydown", this.dragCancelHandler);
      }

      if (this.dragMoveHandler) {
        document.removeEventListener("dragover", this.dragMoveHandler, true);
        document.removeEventListener("pointermove", this.dragMoveHandler, true);
        document.removeEventListener("mousemove", this.dragMoveHandler, true);
        document.removeEventListener("touchmove", this.dragMoveHandler, true);
      }

      this.activeDepth = 0;
      this.activeId = null;
      this.dragCanceled = false;
      this.dragOffset = 0;
      this.dragOrder = [];
      this.dragStartX = 0;
      this.dragCancelHandler = null;
      this.dragMoveHandler = null;
      this.projectedDepth = null;
      this.projectedParentId = null;
    },
    submitDelete(): void {
      const form = document.createElement("form");
      const token =
        document.querySelector<HTMLInputElement>("input[name=_token]");
      const method = document.createElement("input");

      form.action = this.deleteDialogUrl;
      form.method = "POST";

      if (token) {
        form.appendChild(token.cloneNode(true));
      }

      method.name = "_method";
      method.type = "hidden";
      method.value = "DELETE";
      form.appendChild(method);

      document.body.appendChild(form);
      form.submit();
    },
    sync(): void {
      this.syncOrder();
      this.syncHierarchy();
      this.syncInputs();
    },
    syncHierarchy(): void {
      const rows = new Map(
        this.getRows().map((row) => [String(row.dataset.treeItem), row]),
      );
      const ordered = this.order.map((id) => this.getItem(id)!);
      const visit = (parentId: TreeId | null, depth: number): void => {
        ordered
          .filter(
            (item) => String(item.parent_id ?? "") === String(parentId ?? ""),
          )
          .forEach((item) => {
            item.depth = depth;
            this.$refs.items.append(rows.get(String(item.id))!);
            visit(item.id, depth + 1);
          });
      };

      visit(null, 0);
      this.syncOrder();
    },
    syncTree(): void {
      this.syncOrder();
      const activeItem = this.getItem(this.activeId);

      if (activeItem && this.activeId !== null && !this.dragCanceled) {
        const projection = this.getProjection();
        activeItem.depth = projection.depth;
        activeItem.parent_id = projection.parentId;
      }

      this.syncHierarchy();
      this.syncInputs();
      this.resetDrag();
    },
    syncInputs(): void {
      const container = this.$refs.input;
      container.replaceChildren();

      if (this.order.length === 0) {
        const input = document.createElement("input");
        input.name = `${this.name}[]`;
        input.type = "hidden";
        input.value = "";
        container.appendChild(input);

        return;
      }

      this.appendInputs(null, this.name, container);
    },
    treeSortConfig() {
      return {
        onChoose: (event: TreeSortEvent) => {
          this.dragStartX = this.getDragStartX(event.originalEvent, event.item);
        },
        onChange: () => this.updateDragProjection(),
        onMove: (event: TreeSortEvent) => {
          const relatedItem = this.getItem(event.related?.dataset.treeItem);

          return (
            !this.dragCanceled &&
            !(
              this.rootExclusive &&
              relatedItem?.depth === 0 &&
              !event.willInsertAfter
            )
          );
        },
        onStart: (event: TreeSortEvent) => {
          document.body.classList.add("sorting");
          this.dragCanceled = false;
          this.activeId = event.item.dataset.treeItem!;
          this.activeDepth = this.getItem(this.activeId)?.depth ?? 0;
          this.dragOrder = [...this.order];
          this.projectedDepth = this.activeDepth;
          this.projectedParentId =
            this.getItem(this.activeId)?.parent_id ?? null;
          this.dragCancelHandler = (keyEvent) => {
            if (keyEvent.key !== "Escape") {
              return;
            }

            keyEvent.preventDefault();
            this.dragCanceled = true;
            this.projectedDepth = this.activeDepth;
            this.projectedParentId =
              this.getItem(this.activeId)?.parent_id ?? null;
            this.restoreOrder(this.dragOrder);
          };
          document.addEventListener("keydown", this.dragCancelHandler);
          this.dragMoveHandler = (moveEvent) =>
            this.updateDragProjection(moveEvent);
          document.addEventListener("dragover", this.dragMoveHandler, true);
          document.addEventListener("pointermove", this.dragMoveHandler, true);
          document.addEventListener("mousemove", this.dragMoveHandler, true);
          document.addEventListener("touchmove", this.dragMoveHandler, {
            capture: true,
            passive: true,
          });
        },
        onEnd: (event: TreeSortEvent) => {
          document.body.classList.remove("sorting");

          if (this.isCanceled(event)) {
            this.restoreOrder(this.dragOrder);
            this.order = [...this.dragOrder];
            this.resetDrag();

            return;
          }

          this.syncTree();
        },
      };
    },
  }));
}

import { useSortable } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import { Switch } from "@narsil-ui/blocks/switch";
import { type DataTableData } from "@narsil-ui/components/data-table";
import { SortableHandle, SortableItemMenu } from "@narsil-ui/components/sortable";
import { useTranslator } from "@narsil-ui/components/translator";
import { upperFirst } from "lodash-es";
import { type ComponentProps } from "react";
import { type DataTableColumn } from "./data-table-features";

type DataTableColumnsItemProps = Pick<
  ComponentProps<typeof SortableItemMenu>,
  "onMoveDown" | "onMoveUp"
> & {
  column: DataTableColumn<DataTableData, unknown>;
};

function DataTableColumnsItem({ column, onMoveDown, onMoveUp }: DataTableColumnsItemProps) {
  const { trans } = useTranslator();

  const { attributes, isDragging, listeners, setNodeRef, transform, transition } = useSortable({
    id: column.id,
  });

  const columnLabel = upperFirst(column.columnDef.header as string);

  const moveColumnLabel = `${trans("ui.move")} '${columnLabel}'`;

  return (
    <div
      className="flex h-9 items-center gap-2 overflow-hidden rounded-md border bg-background pr-1"
      style={{
        transform: CSS.Transform.toString(transform),
        transition,
      }}
    >
      <SortableHandle
        ref={setNodeRef}
        {...attributes}
        {...listeners}
        isDragging={isDragging}
        label={moveColumnLabel}
      />
      <span className="grow">{columnLabel}</span>
      <Switch
        checked={column.getIsVisible()}
        onCheckedChange={(value) => column.toggleVisibility(value)}
      />
      <SortableItemMenu onMoveUp={onMoveUp} onMoveDown={onMoveDown} />
    </div>
  );
}

export default DataTableColumnsItem;

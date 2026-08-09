import { Checkbox } from "@narsil-ui/blocks/checkbox";
import { type DataTableData } from "@narsil-ui/components/data-table";
import { useTranslator } from "@narsil-ui/components/translator";
import {
  createDataTableColumnHelper,
  type DataTableColumnDef,
} from "../data-table-features";

const columnHelper = createDataTableColumnHelper<DataTableData>();

function getSelectColumn(): DataTableColumnDef<DataTableData> {
  const { trans } = useTranslator();

  return columnHelper.display({
    id: "_select",
    header: ({ table }) => {
      const checked = table.getIsAllPageRowsSelected();
      const indeterminate = table.getIsSomePageRowsSelected();

      const label = checked ? trans("Deselect all") : trans("Select all");

      return table.options.data.length > 0 ? (
        <Checkbox
          aria-label={label}
          checked={checked}
          indeterminate={indeterminate}
          onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
        />
      ) : null;
    },
    cell: ({ row }) => {
      const checked = row.getIsSelected();

      const label = checked ? trans("Deselect row") : trans("Select row");

      return (
        <div onClick={(event) => event.stopPropagation()}>
          <Checkbox
            aria-label={label}
            checked={checked}
            onCheckedChange={(value) => {
              row.toggleSelected(!!value);
            }}
          />
        </div>
      );
    },
    enableHiding: false,
    enableSorting: false,
    meta: {
      className: "min-w-9 w-9 max-w-9",
    },
  });
}

export default getSelectColumn;

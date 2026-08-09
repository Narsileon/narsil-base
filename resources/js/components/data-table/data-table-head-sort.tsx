import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import { Icon } from "@narsil-ui/components/icon";
import { useTranslator } from "@narsil-ui/components/translator";
import { type ComponentProps } from "react";
import { type DataTableData } from "@narsil-ui/components/data-table";
import { type DataTableHeader } from "./data-table-features";

type DataTableHeadSortProps = ComponentProps<typeof Button> & {
  header: DataTableHeader<DataTableData, unknown>;
};

function DataTableHeadSort({ className, header, ...props }: DataTableHeadSortProps) {
  const { trans } = useTranslator();

  function getIconName() {
    switch (header.column.getIsSorted()) {
      case "asc":
        return "chevron-up";
      case "desc":
        return "chevron-down";
      default:
        return "chevrons-up-down";
    }
  }

  const label = trans("ui.sort");

  return (
    <Tooltip tooltip={label}>
      <Button
        aria-label={label}
        className={className}
        size="icon"
        variant="ghost-secondary"
        onClick={header.column.getToggleSortingHandler()}
        {...props}
      >
        <Icon name={getIconName()} />
      </Button>
    </Tooltip>
  );
}

export default DataTableHeadSort;

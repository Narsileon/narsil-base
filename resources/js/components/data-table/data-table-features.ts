import type { OptionData } from "@narsil-ui/types";
import {
  columnFilteringFeature,
  columnOrderingFeature,
  columnResizingFeature,
  columnSizingFeature,
  columnVisibilityFeature,
  createColumnHelper,
  globalFilteringFeature,
  metaHelper,
  rowPaginationFeature,
  rowSelectionFeature,
  rowSortingFeature,
  tableFeatures,
  type Column,
  type ColumnDef,
  type Header,
  type ReactTable,
  type RowData,
  type Table,
  type TableOptions,
} from "@tanstack/react-table";

type DataTableColumnMeta = {
  className?: string;
  operators?: OptionData[] | string[];
  type?: string;
};

const dataTableFeatures = tableFeatures({
  columnFilteringFeature,
  columnOrderingFeature,
  columnResizingFeature,
  columnSizingFeature,
  columnVisibilityFeature,
  globalFilteringFeature,
  rowPaginationFeature,
  rowSelectionFeature,
  rowSortingFeature,
  columnMeta: metaHelper<DataTableColumnMeta>(),
});

type DataTableFeatures = typeof dataTableFeatures;

type DataTableColumnDef<TData extends RowData = RowData> = ColumnDef<DataTableFeatures, TData>;

type DataTableColumn<TData extends RowData = RowData, TValue = unknown> = Column<
  DataTableFeatures,
  TData,
  TValue
>;

type DataTableHeader<TData extends RowData = RowData, TValue = unknown> = Header<
  DataTableFeatures,
  TData,
  TValue
>;

type DataTableTable<TData extends RowData = RowData> = Table<DataTableFeatures, TData>;

type DataTableReactTable<TData extends RowData = RowData> = ReactTable<DataTableFeatures, TData>;

type DataTableOptions<TData extends RowData = RowData> = TableOptions<DataTableFeatures, TData>;

function createDataTableColumnHelper<TData extends RowData>() {
  return createColumnHelper<DataTableFeatures, TData>();
}

export {
  createDataTableColumnHelper,
  dataTableFeatures,
  type DataTableColumn,
  type DataTableColumnDef,
  type DataTableColumnMeta,
  type DataTableFeatures,
  type DataTableHeader,
  type DataTableOptions,
  type DataTableReactTable,
  type DataTableTable,
};

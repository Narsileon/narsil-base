import { type PaginationLinks, PaginationMeta } from "@narsil-ui/blocks/pagination";
import type { FormData, RoutesData } from "@narsil-ui/types";
import getMenuColumn from "./columns/menu-column";
import getSelectColumn from "./columns/select-column";
import DataTable from "./data-table";
import DataTableColumns from "./data-table-columns";
import DataTableColumnsItem from "./data-table-columns-item";
import useDataTable from "./data-table-context";
import {
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
} from "./data-table-features";
import DataTableFilterForm from "./data-table-filter-form";
import DataTableFilters from "./data-table-filters";
import DataTableHeadSort from "./data-table-head-sort";
import DataTableInput from "./data-table-input";
import DataTablePageSize from "./data-table-page-size";
import DataTablePresets from "./data-table-presets";
import DataTableProvider from "./data-table-provider";
import DataTableResults from "./data-table-results";
import DataTableRowMenu from "./data-table-row-menu";
import DataTableSelection from "./data-table-selection";

type DataTableData = {
  id: number;
  [key: string]: any;
};

type DataTableCollection<T extends DataTableData = DataTableData> = {
  data: T[];
  links: PaginationLinks;
  meta: PaginationMeta & {
    columns: DataTableColumnDef<T>[];
    form: FormData;
    presets: Presets;
    routes: RoutesData;
    state: DataTableState;
    [key: string]: unknown;
  };
};

type Presets = {
  data: {
    name: string;
    uuid: string;
  }[];
  form: string;
};

type DataTableState = {
  column_filters: { id: string; value: unknown }[];
  column_order: string[];
  column_visibility: Record<string, boolean>;
  global_filter: string;
  page_size: number;
  row_selection: Record<string, true>;
  sorting: { id: string; desc: boolean }[];
  table_name?: string;
  uuid: string;
};

export {
  createDataTableColumnHelper,
  DataTable,
  DataTableColumns,
  DataTableColumnsItem,
  dataTableFeatures,
  DataTableFilterForm,
  DataTableFilters,
  DataTableHeadSort,
  DataTableInput,
  DataTablePageSize,
  DataTablePresets,
  DataTableProvider,
  DataTableResults,
  DataTableRowMenu,
  DataTableSelection,
  getMenuColumn,
  getSelectColumn,
  useDataTable,
};

export type {
  DataTableCollection,
  DataTableColumn,
  DataTableColumnDef,
  DataTableColumnMeta,
  DataTableData,
  DataTableFeatures,
  DataTableHeader,
  DataTableOptions,
  DataTableReactTable,
  DataTableTable,
  DataTableState,
  Presets,
};

import { router } from "@inertiajs/react";
import {
  functionalUpdate,
  useTable,
  type RowSelectionState,
  type TableState,
  type Updater,
} from "@tanstack/react-table";
import { useRef, useState, type ReactNode } from "react";
import { route } from "ziggy-js";
import { type DataTableData, type DataTableState } from ".";
import { DataTableContext } from "./data-table-context";
import {
  dataTableFeatures,
  type DataTableColumnDef,
  type DataTableOptions,
} from "./data-table-features";

type DataTableProviderProps = Partial<
  Omit<DataTableOptions<DataTableData>, "columns" | "data" | "features" | "initialState">
> & {
  children: ReactNode;
  columns: DataTableColumnDef<DataTableData>[];
  data: DataTableData[];
  initialState: DataTableState;
};

function DataTableProvider({
  children,
  columnResizeMode = "onEnd",
  columns,
  data,
  enableColumnFilters = true,
  enableFilters = true,
  enableGlobalFilter = true,
  enableHiding = true,
  enableMultiRowSelection = true,
  enableMultiSort = true,
  enableRowSelection = true,
  enableSorting = true,
  manualFiltering = true,
  manualPagination = true,
  manualSorting = true,
  initialState,
  state,
  ...props
}: DataTableProviderProps) {
  const ref = useRef<Partial<DataTableState>>(null);

  const [tableState, setTableState] = useState<Partial<TableState<typeof dataTableFeatures>>>({
    columnFilters: initialState.column_filters,
    columnOrder: getColumnOrder(),
    columnVisibility: initialState.column_visibility,
    globalFilter: initialState.global_filter,
    pagination: {
      pageIndex: 0,
      pageSize: initialState.page_size,
    },
    rowSelection: initialState.row_selection as RowSelectionState,
    sorting: initialState.sorting,
    ...state,
  });

  function getColumnOrder() {
    const columnIds = columns
      .map((column) => {
        return column.id!;
      })
      .filter(Boolean);

    const validColumns = initialState.column_order.filter((id) => {
      return columnIds.includes(id);
    });

    const missingColumns = columnIds.filter((id) => {
      return !validColumns.includes(id);
    });

    return [...validColumns, ...missingColumns];
  }

  function persistState(next: Partial<TableState<typeof dataTableFeatures>>) {
    const payload = {
      _method: "patch",
      column_filters: next.columnFilters,
      column_order: next.columnOrder,
      column_visibility: next.columnVisibility,
      global_filter: next.globalFilter,
      page_index: next.pagination?.pageIndex,
      page_size: next.pagination?.pageSize,
      row_selection: next.rowSelection,
      sorting: next.sorting,
    };

    if (JSON.stringify(payload) !== JSON.stringify(ref.current)) {
      ref.current = payload;

      router.post(route("narsil.tables.update", initialState.uuid), payload as any, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
      });
    }
  }

  function createStateHandler<TKey extends keyof TableState<typeof dataTableFeatures>>(key: TKey) {
    return (updater: Updater<TableState<typeof dataTableFeatures>[TKey]>) => {
      setTableState((old) => {
        const next = {
          ...old,
          [key]: functionalUpdate(updater, old[key] as TableState<typeof dataTableFeatures>[TKey]),
        };

        persistState(next);

        return next;
      });
    };
  }

  const dataTable = useTable({
    ...props,
    features: dataTableFeatures,
    columnResizeMode,
    columns,
    data,
    enableColumnFilters,
    enableFilters,
    enableGlobalFilter,
    enableHiding,
    enableMultiRowSelection,
    enableMultiSort,
    enableRowSelection,
    enableSorting,
    manualFiltering,
    manualPagination,
    manualSorting,
    state: tableState,
    getRowId: (row) => row.id?.toString() ?? String(row.uuid),
    onColumnFiltersChange: createStateHandler("columnFilters"),
    onColumnOrderChange: createStateHandler("columnOrder"),
    onColumnVisibilityChange: createStateHandler("columnVisibility"),
    onGlobalFilterChange: createStateHandler("globalFilter"),
    onPaginationChange: createStateHandler("pagination"),
    onRowSelectionChange: createStateHandler("rowSelection"),
    onSortingChange: createStateHandler("sorting"),
  });

  return (
    <DataTableContext.Provider value={{ uuid: initialState.uuid, ...dataTable }}>
      {children}
    </DataTableContext.Provider>
  );
}

export default DataTableProvider;

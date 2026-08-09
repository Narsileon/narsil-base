import { createContext, useContext } from "react";
import { type DataTableData } from ".";
import { type DataTableReactTable } from "./data-table-features";

export type DataTableContextProps = DataTableReactTable<DataTableData> & {
  uuid: string;
};

export const DataTableContext = createContext<DataTableContextProps | null>(null);

function useDataTable() {
  const context = useContext(DataTableContext);

  if (!context) {
    throw new Error("useDataTable must be used within a DataTableProvider.");
  }

  return context;
}

export default useDataTable;

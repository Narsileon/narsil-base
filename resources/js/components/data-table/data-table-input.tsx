import { Tooltip } from "@narsil-ui/blocks/tooltip";
import { Button } from "@narsil-ui/components/button";
import { ButtonGroup } from "@narsil-ui/components/button-group";
import { DataTableFilterForm, useDataTable } from "@narsil-ui/components/data-table";
import { Icon } from "@narsil-ui/components/icon";
import {
  InputGroupAddon,
  InputGroupButton,
  InputGroupInput,
  InputGroupRoot,
} from "@narsil-ui/components/input-group";
import { useTranslator } from "@narsil-ui/components/translator";
import { debounce } from "lodash-es";
import { useEffect, useMemo, useState, type ComponentProps } from "react";

type DataTableInputProps = ComponentProps<typeof InputGroupInput>;

function DataTableInput({ className, ...props }: DataTableInputProps) {
  const { trans } = useTranslator();

  const table = useDataTable();

  const [value, setValue] = useState(table.state.globalFilter || "");

  const debouncedSetValue = useMemo(
    () =>
      debounce((value: string) => {
        table.setGlobalFilter(value);
      }, 300),
    [table],
  );

  useEffect(() => {
    debouncedSetValue(value);
  }, [value, debouncedSetValue]);

  const filterLabel = trans("data-table.filters");
  const placeholderLabel = trans("placeholders.search");

  return (
    <ButtonGroup className="grow justify-end">
      <InputGroupRoot className="max-w-3xs place-self-center transition-all duration-300 focus-within:max-w-lg">
        <InputGroupAddon>
          <Icon name="search" />
        </InputGroupAddon>
        <InputGroupInput
          placeholder={placeholderLabel}
          value={value}
          onChange={(event) => setValue(event.target.value)}
          {...props}
        />
        {table.state.globalFilter ? (
          <InputGroupAddon align="inline-end">
            <InputGroupButton size="icon-sm" onClick={() => setValue("")}>
              <Icon name="x" />
            </InputGroupButton>
          </InputGroupAddon>
        ) : null}
      </InputGroupRoot>
      <Tooltip tooltip={filterLabel}>
        <DataTableFilterForm
          render={
            <Button aria-label={filterLabel} className="border-secondary" variant="secondary">
              <Icon name="filter" />
            </Button>
          }
        />
      </Tooltip>
    </ButtonGroup>
  );
}

export default DataTableInput;

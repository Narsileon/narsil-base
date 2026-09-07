import { Button } from "@narsil-ui/components/button";
import {
  ComboboxChip,
  ComboboxChipRemove,
  ComboboxChips,
  ComboboxClear,
  ComboboxEmpty,
  ComboboxInput,
  ComboboxList,
  ComboboxListItem,
  ComboboxPopup,
  ComboboxPopupInput,
  ComboboxPortal,
  ComboboxPositioner,
  ComboboxRoot,
  ComboboxTrigger,
  ComboboxValue,
} from "@narsil-ui/components/combobox";
import { InputGroupInput } from "@narsil-ui/components/input-group";
import { useTranslator } from "@narsil-ui/components/translator";
import { getTranslatableData, getUntranslatableData } from "@narsil-ui/lib/data";
import { cn } from "@narsil-ui/lib/utils";
import type { OptionData, UniqueIdentifier } from "@narsil-ui/types";
import parse from "html-react-parser";
import { debounce, isArray, isEmpty, lowerCase } from "lodash-es";
import { Fragment, useEffect, useMemo, useRef, useState } from "react";
import { route } from "ziggy-js";

type AsyncComboboxProps = {
  className?: string;
  clearable?: boolean;
  disabled?: boolean;
  displayValue?: boolean;
  fetchParams?: Record<string, any>;
  fetchRoute: string;
  id: string;
  initialOptions?: OptionData[];
  labelPath?: string;
  minSearchLength?: number;
  multiple?: boolean;
  placeholder?: string;
  required?: boolean;
  value: UniqueIdentifier | UniqueIdentifier[];
  valuePath?: string;
  setValue: (value: UniqueIdentifier | UniqueIdentifier[]) => void;
};

function AsyncCombobox({
  className,
  clearable = false,
  disabled,
  displayValue = true,
  fetchParams = {},
  fetchRoute,
  initialOptions = [],
  labelPath = "label",
  minSearchLength = 3,
  multiple = false,
  placeholder,
  required,
  value,
  valuePath = "value",
  setValue,
}: AsyncComboboxProps) {
  const { locale, trans } = useTranslator();

  if (multiple && !isArray(value)) {
    value = value ? [value] : [];
  }

  const anchor = useRef<HTMLDivElement>(null);

  const [loading, setLoading] = useState(false);
  const [open, setOpen] = useState(false);
  const [options, setOptions] = useState<OptionData[]>(initialOptions);
  const [searchValue, setSearchValue] = useState("");

  const filteredItems = useMemo(() => {
    if (!searchValue || searchValue.length < minSearchLength) {
      return [];
    }

    const searchedLabel = lowerCase(searchValue);

    return options.filter((option) => {
      const optionLabel = getTranslatableData(option, labelPath, locale);

      return lowerCase(optionLabel).includes(searchedLabel);
    });
  }, [locale, options, searchValue]);

  const selectedValues = useMemo<UniqueIdentifier[]>(() => {
    return multiple ? (value as UniqueIdentifier[]) : value ? [value as UniqueIdentifier] : [];
  }, [value, multiple]);

  const selectedOptions = useMemo(() => {
    return options.filter((option) =>
      selectedValues.includes(getUntranslatableData(option, valuePath)),
    );
  }, [options, selectedValues, valuePath]);

  async function fetchOptions(search?: string) {
    if (!search || search.length < minSearchLength) {
      return;
    }

    setLoading(true);

    try {
      const url = new URL(route(fetchRoute, fetchParams), window.location.origin);

      url.searchParams.set("search", search);

      const response = await fetch(url.toString(), {
        headers: { Accept: "application/json" },
      });

      const data = await response.json();

      setOptions((prev) => {
        const merged = [...prev, ...(data ?? [])];

        const seen = new Set<UniqueIdentifier>();

        return merged.filter((item) => {
          const value = getUntranslatableData(item, valuePath);

          if (seen.has(value)) {
            return false;
          }

          seen.add(value);

          return true;
        });
      });
    } catch (error) {
      console.error("AsyncCombobox fetch error:", error);
    } finally {
      setLoading(false);
    }
  }

  const debouncedFetch = useMemo(() => debounce(fetchOptions, 400), []);

  useEffect(() => {
    if (open) {
      debouncedFetch(searchValue);
    }
  }, [open, searchValue]);

  function onSelect(selectedValue: UniqueIdentifier) {
    if (!selectedValue) {
      return;
    }

    if (multiple) {
      if (selectedValues.includes(selectedValue)) {
        setValue(selectedValues.filter((x) => x !== selectedValue));
      } else {
        setValue([...selectedValues, selectedValue]);
      }
    } else {
      setValue(selectedValue);
      setOpen(false);
    }
  }

  return (
    <ComboboxRoot
      filteredItems={filteredItems}
      items={options}
      multiple={multiple ? undefined : false}
      onInputValueChange={setSearchValue}
      onOpenChange={setOpen}
      open={open}
      onValueChange={(value) => onSelect(value as string)}
      required={required}
      value={value}
    >
      {multiple ? (
        <ComboboxChips ref={anchor}>
          <ComboboxValue>
            {(value) => (
              <Fragment>
                {value.map((item: string) => {
                  const option = selectedOptions.find((option) => {
                    return getUntranslatableData(option, valuePath) === item;
                  });

                  if (!option) {
                    return null;
                  }

                  const optionLabel = getTranslatableData(option, labelPath, locale);

                  return (
                    <ComboboxChip key={item}>
                      {parse(optionLabel)}
                      <ComboboxChipRemove />
                    </ComboboxChip>
                  );
                })}
                <ComboboxInput
                  className="h-7 p-0"
                  placeholder={placeholder ?? trans("placeholders.search")}
                  render={<InputGroupInput disabled={disabled} />}
                />
                {clearable && !isEmpty(value) ? <ComboboxClear disabled={disabled} /> : null}
              </Fragment>
            )}
          </ComboboxValue>
        </ComboboxChips>
      ) : (
        <ComboboxTrigger
          render={
            <Button variant="input" className={cn("w-full justify-between font-normal", className)}>
              {selectedOptions[0]
                ? parse(getTranslatableData(selectedOptions[0], labelPath, locale))
                : (placeholder ?? trans("placeholders.choose"))}
            </Button>
          }
        />
      )}
      <ComboboxPortal>
        <ComboboxPositioner anchor={anchor}>
          <ComboboxPopup>
            {!multiple && (
              <ComboboxPopupInput
                clearable={clearable && !isEmpty(searchValue)}
                disabled={disabled}
              />
            )}
            {loading && <div className="p-2 text-sm text-muted-foreground">...</div>}
            <ComboboxEmpty>{trans("pagination.empty")}</ComboboxEmpty>
            <ComboboxList>
              {(item) => {
                const optionLabel = getTranslatableData(item, labelPath, locale);
                const optionValue = getUntranslatableData(item, valuePath);

                return (
                  <ComboboxListItem
                    displayValue={displayValue}
                    icon={item.icon}
                    label={optionLabel}
                    value={optionValue}
                    key={optionValue}
                  />
                );
              }}
            </ComboboxList>
          </ComboboxPopup>
        </ComboboxPositioner>
      </ComboboxPortal>
    </ComboboxRoot>
  );
}

export default AsyncCombobox;

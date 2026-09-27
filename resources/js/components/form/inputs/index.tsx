import { dynamic } from "@narsil-ui/lib/dynamic";
import type { FieldData } from "@narsil-ui/types";
import { type ReactNode } from "react";

export type FieldProps = FieldData & {
  value: any;
  setValue: (value: any) => void;
};

export type Registry = {
  [K in FieldProps["input"]["type"]]: (props: FieldProps) => ReactNode;
};

const ArrayInput = dynamic(() => import("./array-input"));
const AssetInput = dynamic(() => import("./asset-input"));
const CheckboxInput = dynamic(() => import("./checkbox-input"));
const Combobox = dynamic(
  () => import("@narsil-ui/components/combobox/combobox"),
);
const FileInput = dynamic(() => import("./file-input"));
const IconInput = dynamic(() => import("./icon-input"));
const PasswordInput = dynamic(() => import("./password-input"));
const RangeInput = dynamic(() => import("./range-input"));
const SwitchInput = dynamic(() => import("./switch-input"));
const TableInput = dynamic(() => import("./table-input"));
const TextInput = dynamic(() => import("./text-input"));

const registry: Registry = {
  ["array"]: (props) => {
    return <ArrayInput {...props} />;
  },
  ["asset"]: (props) => {
    return <AssetInput {...props} />;
  },
  ["checkbox"]: (props) => {
    return <CheckboxInput {...props} />;
  },
  ["file"]: (props) => {
    return <FileInput {...props} />;
  },
  ["icon"]: (props) => {
    return <IconInput {...props} />;
  },
  ["password"]: (props) => {
    return <PasswordInput {...props} />;
  },
  ["range"]: (props) => {
    return <RangeInput {...props} />;
  },
  ["select"]: (props) => {
    return (
      <Combobox
        {...props.input}
        id={props.id}
        options={props.input.options}
        required={props.required}
        value={props.value}
        setValue={props.setValue}
      />
    );
  },
  ["switch"]: (props) => {
    return <SwitchInput {...props} />;
  },
  ["table"]: (props) => {
    return <TableInput {...props} />;
  },
  ["default"]: (props) => {
    return <TextInput {...props} />;
  },
};

export function getField<K extends keyof Registry>(
  registry: Registry,
  name: K,
  props: FieldProps,
) {
  const FieldComponent = registry[name] ?? registry.default;
  return <FieldComponent {...props} />;
}

export function registerField(
  type: string,
  component: (props: FieldProps) => ReactNode,
) {
  registry[type as keyof Registry] = component;
}

export default registry;

import type { InertiaLinkProps } from "@inertiajs/react";
import { type IconName } from "@narsil-ui/registries/icons";

export type MenuItem = {
  group?: string;
  icon?: IconName;
  label: string;
  method: InertiaLinkProps["method"];
  modal?: boolean;
  parameters?: Record<string, unknown>;
  route: string;
  target?: string;
};

export type ConditionData = {
  handle: string;
  operator: string;
  value: string;
};

export type FieldsetData = {
  conditions: ConditionData[];
  description?: string | null;
  elements: Array<FieldsetData | FieldData>;
  id?: string | null;
  label?: string | null;
  [key: string]: unknown;
};

export type FormData = {
  action: string;
  autoSave: boolean;
  defaultLanguage: string;
  id: string;
  languages: OptionData[];
  method: string;
  options: Record<string, OptionData[]>;
  routes: RoutesData;
  steps: FormStepData[];
  submitIcon?: string | null;
  submitLabel: string;
};

export type FormStepData = {
  description?: string | null;
  elements: Array<FieldsetData | FieldData>;
  id?: string | null;
  label?: string | null;
};

export type FieldData = {
  append?: string | null;
  className?: string | null;
  conditions: ConditionData[];
  description?: string | null;
  icon?: string | null;
  id: string;
  label: string;
  readOnly?: boolean;
  required?: boolean;
  translatable: boolean;
  width: number;
  input: {
    type: string;
    [key: string]: any;
  };
};

export type OptionData<T = unknown> = {
  [key: string]: unknown;
  icon?: IconName;
  label: string | Record<string, string>;
  value: T;
};

export type RoutesData = Record<string, string> & {
  parameters?: Record<string, unknown>;
};

export type UniqueIdentifier = number | string;

export type UserData = {
  avatar: string;
  email: string;
  first_name: string;
  full_name: string;
  id: number;
  last_name: string;
  two_factor_confirmed_at: string;
};

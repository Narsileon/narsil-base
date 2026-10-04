import type Alpine from "alpinejs";
import registerDropdownStore from "./dropdown/dropdown-store";

export default function registerAlpineStores(alpine: typeof Alpine): void {
  registerDropdownStore(alpine);
}

import type Alpine from "alpinejs";

type DropdownStore = {
  active: string | null;
  open: (this: DropdownStore, id: string) => void;
  close: (this: DropdownStore, id: string) => void;
  toggle: (this: DropdownStore, id: string) => void;
};

export default function registerAlpineStores(alpine: typeof Alpine): void {
  const dropdownStore: DropdownStore = {
    active: null,
    close(id: string): void {
      if (this.active === id) {
        this.active = null;
      }
    },
    open(id: string): void {
      this.active = id;
    },
    toggle(id: string): void {
      this.active = this.active === id ? null : id;
    },
  };

  alpine.store("narsilDropdown", dropdownStore);
}

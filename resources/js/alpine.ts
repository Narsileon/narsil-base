import anchor from "@alpinejs/anchor";
import collapse from "@alpinejs/collapse";
import sort from "@alpinejs/sort";
import Alpine from "alpinejs";

Alpine.plugin([anchor, collapse, sort]);

export function registerAlpineStores(alpine = Alpine): void {
	type DropdownStore = {
		active: string | null;
		open: (this: DropdownStore, id: string) => void;
		close: (this: DropdownStore, id: string) => void;
		toggle: (this: DropdownStore, id: string) => void;
	};
	const dropdownStore: DropdownStore = {
		active: null as string | null,
		open(id: string): void {
			this.active = id;
		},
		close(id: string): void {
			if (this.active === id) {
				this.active = null;
			}
		},
		toggle(id: string): void {
			this.active = this.active === id ? null : id;
		},
	};

	alpine.store('narsilDropdown', dropdownStore);
}

registerAlpineStores();

export default Alpine;

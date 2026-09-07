import anchor from "@alpinejs/anchor";
import collapse from "@alpinejs/collapse";
import sort from "@alpinejs/sort";
import Alpine from "alpinejs";

Alpine.plugin([anchor, collapse, sort]);

type SortableInputConfig = {
	itemsRef: string;
	itemSelector: string;
	templateSelector: string;
	indexToken: string;
	uuidToken: string;
	prefix: string;
	idPrefix?: string;
	placeholderSelector?: string;
};

export function registerAlpineComponents(alpine = Alpine): void {
	alpine.data('narsilSortableInput', (config: SortableInputConfig) => ({
		order: [] as string[],
		init(): void {
			this.sync();
		},
		sync(): void {
			this.order = Array.from(
				this.$refs[config.itemsRef].querySelectorAll(config.itemSelector),
			).map((item) => item.getAttribute('data-sortable-item') ?? '');
			this.reindex();
		},
		reindex(): void {
			const escapedPrefix = config.prefix.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
			const namePattern = new RegExp('^' + escapedPrefix + '\\[\\d+\\]');
			const idPattern = config.idPrefix
				? new RegExp(
						'^' +
						config.idPrefix.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') +
						'\\.\\d+',
					)
				: /\.\d+(?=\.|$)/;

			this.$refs[config.itemsRef]
				.querySelectorAll(config.itemSelector)
				.forEach((item, index) => {
					item.querySelectorAll('[name]').forEach((input) => {
						input.setAttribute(
							'name',
							(input.getAttribute('name') ?? '').replace(
								namePattern,
								config.prefix + '[' + index + ']',
							),
						);
					});
					item.querySelectorAll('[id]').forEach((input) => {
						input.id = input.id.replace(
							idPattern,
							(config.idPrefix ?? '') + '.' + index,
						);
					});
				});
		},
		replaceTemplateValues(root: ParentNode, index: number, uuid: string): void {
			const nodes = Array.from(root.querySelectorAll('*'));

			if (root instanceof Element) {
				nodes.unshift(root);
			}

			nodes.forEach((node) => {
				Array.from(node.attributes).forEach((attribute) => {
					attribute.value = attribute.value
						.replaceAll(config.indexToken, String(index))
						.replaceAll(config.uuidToken, uuid);
				});
			});

			root.querySelectorAll('template').forEach((template) => {
				this.replaceTemplateValues(template.content, index, uuid);
			});
		},
		add(): void {
			const template = this.$root.querySelector<HTMLTemplateElement>(
				config.templateSelector,
			);

			if (!template) {
				return;
			}

			const fragment = template.content.cloneNode(true) as DocumentFragment;
			const item = fragment.firstElementChild;

			if (!item) {
				return;
			}

			const items = this.$refs[config.itemsRef];
			const index = items.querySelectorAll(config.itemSelector).length;
			const uuid = crypto.randomUUID();

			this.replaceTemplateValues(item, index, uuid);

			const placeholder = config.placeholderSelector
				? items.querySelector(config.placeholderSelector)
				: null;

			if (placeholder) {
				placeholder.before(item);
			} else {
				items.appendChild(item);
			}

			alpine.initTree(item as Alpine.ElementWithXAttributes);
			this.sync();
		},
		remove(item: Element): void {
			item.remove();
			this.sync();
		},
		removeById(id: string): void {
			const item = Array.from(
				this.$refs[config.itemsRef].querySelectorAll(config.itemSelector),
			).find((candidate) => candidate.getAttribute('data-sortable-item') === id);

			if (item) {
				this.remove(item);
			}
		},
		moveById(id: string, direction: number): void {
			const items = Array.from(
				this.$refs[config.itemsRef].querySelectorAll(config.itemSelector),
			);
			const item = items.find(
				(candidate) => candidate.getAttribute('data-sortable-item') === id,
			);

			if (!item) {
				return;
			}

			const index = items.indexOf(item);
			const next = index + direction;

			if (next < 0 || next >= items.length) {
				return;
			}

			if (direction < 0) {
				items[next].before(item);
			} else {
				items[next].after(item);
			}

			this.sync();
		},
	}));
}

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
registerAlpineComponents();

export default Alpine;

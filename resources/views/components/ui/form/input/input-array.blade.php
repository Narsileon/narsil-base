<div
	class="grid gap-4"
	x-data="{
    order: [],
    init() {
        this.sync();
    },
    sync() {
        this.order = Array.from(this.$refs.items.querySelectorAll('[data-array-item]'))
            .map((item) => item.dataset.sortableItem);
        this.reindex();
    },
    reindex() {
        const prefix = {{ Illuminate\Support\Js::from($name) }};
        const escaped = prefix.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const pattern = new RegExp('^' + escaped + '\\[\\d+\\]');

        this.$refs.items.querySelectorAll('[data-array-item]').forEach((item, index) => {
            item.querySelectorAll('[name]').forEach((input) => {
                input.name = input.name.replace(pattern, prefix + '[' + index + ']');
            });
            item.querySelectorAll('[id]').forEach((input) => {
                input.id = input.id.replace(/\.\d+(?=\.|$)/, '.' + index);
            });
        });
    },
    replaceTemplateValues(root, index, uuid) {
        const nodes = Array.from(root.querySelectorAll('*'));

        if (root.attributes) {
            nodes.unshift(root);
        }

        nodes.forEach((node) => {
            Array.from(node.attributes || []).forEach((attribute) => {
                attribute.value = attribute.value
                    .replaceAll('__ARRAY_INDEX__', String(index))
                    .replaceAll('__ARRAY_UUID__', uuid);
            });
        });

        root.querySelectorAll('template').forEach((template) => {
            this.replaceTemplateValues(template.content, index, uuid);
        });
    },
    add() {
        const template = this.$root.querySelector(':scope > template[data-array-template]');
        const fragment = template.content.cloneNode(true);
        const item = fragment.firstElementChild;
        const index = this.$refs.items.querySelectorAll('[data-array-item]').length;
        const uuid = crypto.randomUUID();

        this.replaceTemplateValues(item, index, uuid);
        this.$refs.items.appendChild(item);
        Alpine.initTree(item);
        this.sync();
    },
    remove(item) {
        item.remove();
        this.sync();
    },
    removeById(id) {
        const item = Array.from(this.$refs.items.querySelectorAll('[data-array-item]'))
            .find((candidate) => candidate.dataset.sortableItem === id);

        if (!item) {
            return;
        }

        this.remove(item);
    },
    moveById(id, direction) {
        const items = Array.from(this.$refs.items.querySelectorAll('[data-array-item]'));
        const item = items.find((candidate) => candidate.dataset.sortableItem === id);

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
    }
}"
		x-init="sync()"
		x-on:sortable-list-move.window="moveById($event.detail.id, $event.detail.direction)"
		x-on:sortable-list-remove.window="removeById($event.detail.id)"
>
	<div
		class="grid gap-4"
		x-ref="items"
		x-sort="sync()"
	>
		@foreach ($items as $index => $item)
			@php
				$itemUuid = data_get($item, 'uuid', 'item-' . $index);
				$itemLabel = data_get($item, $input->labelPath ?? 'label', $index + 1);
			@endphp
			<div
				class="overflow-hidden rounded-xl border bg-card text-card-foreground shadow-sm"
				data-array-item
				data-sortable-item="{{ $itemUuid }}"
				x-sort:item="{{ $itemUuid }}"
			>
				<input
					name="{{ $name }}[{{ $index }}][uuid]"
					type="hidden"
					value="{{ $itemUuid }}"
				>
				<div
					class="flex min-h-9 items-center justify-between gap-2 border-b bg-card px-1"
				>
					<span class="px-2 text-sm font-medium">{{ $itemLabel }}</span>
					<div class="flex items-center gap-1">
						<x-narsil::ui.sortable-item-menu.root
							:id="$itemUuid"
						>
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
								data-sortable-item="{{ $itemUuid }}"
								x-on:click="$dispatch('sortable-list-remove', { id: $el.dataset.sortableItem }); dropdownOpen = false"
							>
								<x-narsil::ui.icon.icon-root
									class="text-destructive"
									name="trash"
								/>
								{{ trans('narsil::ui.delete') }}
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						</x-narsil::ui.sortable-item-menu.root>
					</div>
				</div>
				<div class="grid gap-6 p-4">
					@foreach ($input->elements ?? [] as $childElement)
						<x-narsil::ui.form.form-element
							:element="$childElement"
							:id="$id . '.' . $index . '.' . $childElement->id"
							:languages="$languages"
							:value="data_get($item, $childElement->id)"
						/>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
	<template data-array-template>
			<div
				class="overflow-hidden rounded-xl border bg-card text-card-foreground shadow-sm"
				data-array-item
				data-sortable-item="__ARRAY_UUID__"
				x-sort:item="__ARRAY_UUID__"
			>
				<input
					name="{{ $name }}[__ARRAY_INDEX__][uuid]"
					type="hidden"
					value="__ARRAY_UUID__"
				>
				<div class="flex min-h-9 items-center justify-between gap-2 border-b bg-card px-1">
					<span class="px-2 text-sm font-medium" x-text="'Item ' + ({{ count($items) }} + 1)"></span>
					<div class="flex items-center gap-1">
						<x-narsil::ui.sortable-item-menu.root
							id="__ARRAY_UUID__"
						>
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
								data-sortable-item="__ARRAY_UUID__"
								x-on:click="$dispatch('sortable-list-remove', { id: $el.dataset.sortableItem }); dropdownOpen = false"
							>
								<x-narsil::ui.icon.icon-root
									class="text-destructive"
									name="trash"
								/>
								{{ trans('narsil::ui.delete') }}
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						</x-narsil::ui.sortable-item-menu.root>
					</div>
			</div>
			<div class="grid gap-6 p-4">
				@foreach ($input->elements ?? [] as $childElement)
					<x-narsil::ui.form.form-element
						:element="$childElement"
						:id="$id . '.__ARRAY_INDEX__.' . $childElement->id"
						:languages="$languages"
					/>
				@endforeach
			</div>
		</div>
	</template>
	<x-narsil::ui.button.button-root
		class="w-fit"
		type="button"
		x-on:click="add()"
	>
		<x-narsil::ui.icon.icon-root name="plus" />
		{{ trans('narsil::ui.add') }}
	</x-narsil::ui.button.button-root>
</div>

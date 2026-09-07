<div
	class="grid gap-4"
	x-data="narsilSortableInput({
		itemsRef: 'items',
		itemSelector: '[data-array-item]',
		templateSelector: ':scope > template[data-array-template]',
		indexToken: '__ARRAY_INDEX__',
		uuidToken: '__ARRAY_UUID__',
		prefix: {{ Illuminate\Support\Js::from($name) }},
	})"
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

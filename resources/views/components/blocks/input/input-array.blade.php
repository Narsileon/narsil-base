<div
	class="grid gap-4"
	x-data="narsilSortableList({
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
	@if ($hasItems)
		<div
			class="grid gap-4"
			x-ref="items"
			x-sort="sync()"
		>
			@foreach ($items as $index => $item)
				@php
					$itemUuid = data_get($item, 'uuid', 'item-' . $index);
				@endphp
				<x-narsil::ui.collapsible.collapsible-root
					:open="true"
					class="bg-card text-card-foreground overflow-hidden rounded-xl border shadow-sm"
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
						class="bg-card py-0! flex min-h-9 items-center justify-between gap-2 pl-0 pr-1"
						x-bind:class="collapsibleOpen ? 'border-b' : ''"
					>
						<x-narsil::ui.sortable.sortable-handle
							aria-label="{{ trans('narsil::ui.move') }}"
						/>
						<x-narsil::ui.collapsible.collapsible-trigger
							class="flex h-9 min-w-0 grow items-center justify-start gap-2 px-2 text-start"
						>
							<span
								class="text-start text-sm font-medium"
							>
								{{ $itemLabels[$index] }}
							</span>
							<x-narsil::ui.icon.icon-root
								class="size-4 duration-300"
								name="fa-solid-chevron-right"
								x-bind:class="collapsibleOpen ? 'rotate-90' : 'rotate-0'"
							/>
						</x-narsil::ui.collapsible.collapsible-trigger>
						<div
							class="flex items-center gap-1"
						>
							<x-narsil::blocks.sortable.sortable-item-menu
								:id="$itemUuid"
							>
								<x-narsil::ui.dropdown-menu.dropdown-menu-item
									class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
									data-sortable-item="{{ $itemUuid }}"
									x-on:click="$dispatch('sortable-list-remove', { id: $el.dataset.sortableItem }); dropdownOpen = false"
								>
									<x-narsil::ui.icon.icon-root
										class="text-destructive"
										name="fa-regular-trash"
									/>
									{{ trans('narsil::ui.delete') }}
								</x-narsil::ui.dropdown-menu.dropdown-menu-item>
							</x-narsil::blocks.sortable.sortable-item-menu>
						</div>
					</div>
					<x-narsil::ui.collapsible.collapsible-panel
						class="grid gap-6 p-4"
					>
						@foreach ($input->elements ?? [] as $childElement)
							<x-narsil::ui.form.form-element
								:element="$childElement"
								:id="$id . '.' . $index . '.' . $childElement->id"
								:languages="$languages"
								:value="data_get($item, $childElement->id)"
							/>
						@endforeach
					</x-narsil::ui.collapsible.collapsible-panel>
				</x-narsil::ui.collapsible.collapsible-root>
			@endforeach
		</div>
	@endif
	<template
		data-array-template
	>
		<x-narsil::ui.collapsible.collapsible-root
			:open="true"
			class="bg-card text-card-foreground overflow-hidden rounded-xl border shadow-sm"
			data-array-item
			data-sortable-item="__ARRAY_UUID__"
			x-sort:item="__ARRAY_UUID__"
		>
			<input
				name="{{ $name }}[__ARRAY_INDEX__][uuid]"
				type="hidden"
				value="__ARRAY_UUID__"
			>
			<div
				class="bg-card py-0! flex min-h-9 items-center justify-between gap-2 pl-0 pr-1"
				x-bind:class="collapsibleOpen ? 'border-b' : ''"
			>
				<x-narsil::ui.sortable.sortable-handle
					aria-label="{{ trans('narsil::ui.move') }}"
				/>
				<x-narsil::ui.collapsible.collapsible-trigger
					class="flex h-9 min-w-0 grow items-center justify-start gap-2 px-2 text-start"
				>
					<span
						class="text-start text-sm font-medium"
						x-text="'Item ' + (order.indexOf($el.closest('[data-array-item]').getAttribute('data-sortable-item')) + 1)"
					></span>
					<x-narsil::ui.icon.icon-root
						class="size-4 duration-300"
						name="fa-solid-chevron-right"
						x-bind:class="collapsibleOpen ? 'rotate-90' : 'rotate-0'"
					/>
				</x-narsil::ui.collapsible.collapsible-trigger>
				<div
					class="flex items-center gap-1"
				>
					<x-narsil::blocks.sortable.sortable-item-menu
						id="__ARRAY_UUID__"
					>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
							data-sortable-item="__ARRAY_UUID__"
							x-on:click="$dispatch('sortable-list-remove', { id: $el.dataset.sortableItem }); dropdownOpen = false"
						>
							<x-narsil::ui.icon.icon-root
								class="text-destructive"
								name="fa-regular-trash"
							/>
							{{ trans('narsil::ui.delete') }}
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
					</x-narsil::blocks.sortable.sortable-item-menu>
				</div>
			</div>
			<x-narsil::ui.collapsible.collapsible-panel
				class="grid gap-6 p-4"
			>
				@foreach ($input->elements ?? [] as $childElement)
					<x-narsil::ui.form.form-element
						:element="$childElement"
						:id="$id . '.__ARRAY_INDEX__.' . $childElement->id"
						:languages="$languages"
					/>
				@endforeach
			</x-narsil::ui.collapsible.collapsible-panel>
		</x-narsil::ui.collapsible.collapsible-root>
	</template>
	<x-narsil::ui.button.button-root
		class="w-fit"
		type="button"
		x-on:click="add()"
	>
		<x-narsil::ui.icon.icon-root
			name="fa-regular-plus"
		/>
		{{ trans('narsil::ui.add') }}
	</x-narsil::ui.button.button-root>
</div>

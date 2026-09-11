<div
	class="min-w-0"
	x-data="narsilSortableList({
    itemsRef: 'rows',
    itemSelector: '[data-table-row]',
    templateSelector: ':scope > template[data-table-template]',
    indexToken: '__ROW__',
    uuidToken: '__TABLE_UUID__',
    prefix: {{ Illuminate\Support\Js::from($name) }},
    idPrefix: {{ Illuminate\Support\Js::from((string) $id) }},
    placeholderSelector: '[data-table-placeholder]',
})"
	x-on:sortable-list-move.window="moveById($event.detail.id, $event.detail.direction)"
	x-on:sortable-list-remove.window="removeById($event.detail.id)"
>
	<x-narsil::ui.table.table-wrapper>
		<x-narsil::ui.table.table-root
			class="w-full max-w-full table-fixed"
		>
			<x-narsil::ui.table.table-header>
				<x-narsil::ui.table.table-row
					class="bg-accent"
				>
					<x-narsil::ui.table.table-head
						class="w-9"
					/>
					@foreach ($input->columns ?? [] as $column)
						<x-narsil::ui.table.table-head
							class="px-3"
						>
							<x-narsil::ui.field.field-label
								:required="$column->required ?? false"
							>
								{{ $column->label ?? $column->id }}
							</x-narsil::ui.field.field-label>
						</x-narsil::ui.table.table-head>
					@endforeach
					<x-narsil::ui.table.table-head
						class="w-9"
					/>
				</x-narsil::ui.table.table-row>
			</x-narsil::ui.table.table-header>
			<x-narsil::ui.table.table-body
				x-ref="rows"
				x-sort="sync()"
			>
				@foreach ($rows as $index => $row)
					@php
						$rowUuid = data_get($row, 'uuid', 'row-' . $index);
					@endphp
					<x-narsil::ui.table.table-row
						data-sortable-item="{{ $rowUuid }}"
						data-table-row
						x-sort:item="{{ $rowUuid }}"
					>
						<x-narsil::ui.table.table-cell
							class="px-1 py-0"
						>
							<x-narsil::ui.sortable.sortable-handle
								aria-label="{{ trans('narsil::ui.move') }}"
							/>
							<input
								name="{{ $name }}[{{ $index }}][uuid]"
								type="hidden"
								value="{{ $rowUuid }}"
							>
						</x-narsil::ui.table.table-cell>
						@foreach ($input->columns ?? [] as $column)
							<x-narsil::ui.table.table-cell
								class="px-0.5 py-0"
							>
								<x-narsil::ui.form.form-element
									:bare="true"
									:element="$column"
									:id="$id . '.' . $index . '.' . $column->id"
									:languages="$languages"
									:value="data_get($row, $column->id, data_get($column, 'input.defaultValue'))"
								/>
							</x-narsil::ui.table.table-cell>
						@endforeach
						<x-narsil::ui.table.table-cell
							class="px-1 py-0"
						>
							<div
								class="flex items-center justify-end gap-1"
							>
								<x-narsil::blocks.sortable.sortable-item-menu
									:id="$rowUuid"
								>
									<x-narsil::ui.dropdown-menu.dropdown-menu-item
										class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
										data-sortable-item="{{ $rowUuid }}"
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
						</x-narsil::ui.table.table-cell>
					</x-narsil::ui.table.table-row>
				@endforeach
				<x-narsil::ui.table.table-row
					class="cursor-pointer border-dashed bg-transparent opacity-50 hover:opacity-100"
					data-table-placeholder
					x-on:click="add()"
				>
					<x-narsil::ui.table.table-cell
						:colspan="count($input->columns ?? []) + 2"
					>
						<div
							class="flex items-center justify-center gap-1"
						>
							<x-narsil::ui.icon.icon-root
								name="fa-regular-plus"
							/>
							<span>
								{{ trans('narsil::ui.add') }}
							</span>
						</div>
					</x-narsil::ui.table.table-cell>
				</x-narsil::ui.table.table-row>
			</x-narsil::ui.table.table-body>
		</x-narsil::ui.table.table-root>
	</x-narsil::ui.table.table-wrapper>
	<template
		data-table-template
	>
		<x-narsil::ui.table.table-row
			data-sortable-item="__TABLE_UUID__"
			data-table-row
			x-sort:item="__TABLE_UUID__"
		>
			<x-narsil::ui.table.table-cell
				class="px-1 py-0"
			>
				<x-narsil::ui.sortable.sortable-handle
					aria-label="{{ trans('narsil::ui.move') }}"
				/>
				<input
					name="{{ $name }}[__ROW__][uuid]"
					type="hidden"
					value="__TABLE_UUID__"
				>
			</x-narsil::ui.table.table-cell>
			@foreach ($input->columns ?? [] as $column)
				<x-narsil::ui.table.table-cell
					class="px-0.5 py-0"
				>
					<x-narsil::ui.form.form-element
						:bare="true"
						:element="$column"
						:id="$id . '.__ROW__.' . $column->id"
						:languages="$languages"
					/>
				</x-narsil::ui.table.table-cell>
			@endforeach
			<x-narsil::ui.table.table-cell
				class="px-1 py-0"
			>
				<div
					class="flex items-center justify-end gap-1"
				>
					<x-narsil::blocks.sortable.sortable-item-menu
						id="__TABLE_UUID__"
					>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							class="text-destructive hover:bg-destructive/10 hover:text-destructive focus:bg-destructive/10 focus:text-destructive"
							data-sortable-item="__TABLE_UUID__"
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
			</x-narsil::ui.table.table-cell>
		</x-narsil::ui.table.table-row>
	</template>
</div>

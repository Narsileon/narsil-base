@php
	$meta = data_get($payload, 'meta', []);
	$state = data_get($meta, 'state', []);
	$columns = collect(data_get($meta, 'columns', []))->map(
	    fn($column) => is_object($column) && method_exists($column, 'toArray') ? $column->toArray() : (array) $column,
	);
	$order = data_get($state, 'column_order', []);
	$columns = collect($order)
	    ->map(fn($id) => $columns->firstWhere('id', $id))
	    ->filter()
	    ->merge($columns->reject(fn($column) => in_array($column['id'], $order, true)));
	$visible = data_get($state, 'column_visibility', []);
	$data = data_get($payload, 'data', []);
	$routes = data_get($meta, 'routes', []);
	$parameters = data_get($routes, 'parameters', []);
@endphp
<x-narsil::ui.table.table-wrapper
	class="min-h-0 grow"
>
	<x-narsil::ui.table.table-root
		class="min-w-max"
	>
		<x-narsil::ui.table.table-header>
			<x-narsil::ui.table.table-row
				class="bg-accent sticky top-0 z-10"
			>
				@if (data_get($meta, 'selectable', true) !== false)
					<x-narsil::ui.table.table-head
						class="w-9"
					>
						<x-narsil::blocks.checkbox.checkbox-root
							aria-label="{{ trans('narsil::data-table.select_all') }}"
							x-effect="checked = ids.length > 0 && ids.every((id) => selected[id])"
							x-on:click="checked = !checked; selected = checked ? Object.fromEntries(ids.map((id) => [id, true])) : {}"
						/>
					</x-narsil::ui.table.table-head>
				@endif
				@foreach ($columns as $column)
					@if (data_get($visible, $column['id'], $column['visibility'] ?? true))
						<x-narsil::ui.table.table-head>
							<x-narsil::blocks.data-table.data-table-head-sort
								:column="$column"
								:payload="$payload"
							/>
						</x-narsil::ui.table.table-head>
					@endif
				@endforeach
				@if (data_get($routes, 'edit') || data_get($routes, 'destroy'))
					<x-narsil::ui.table.table-head
						class="min-w-13 w-13 max-w-13 mask-l-from-85% mask-no-repeat sticky right-0 z-20"
					/>
				@endif
			</x-narsil::ui.table.table-row>
		</x-narsil::ui.table.table-header>
		<x-narsil::ui.table.table-body>
			@forelse ($data as $row)
				@php $rowId = data_get($row, 'id', data_get($row, 'uuid')); @endphp
				<x-narsil::ui.table.table-row
					class="cursor-pointer"
				>
					@if (data_get($meta, 'selectable', true) !== false)
						<x-narsil::ui.table.table-cell>
							<x-narsil::blocks.checkbox.checkbox-root
								aria-label="{{ trans('narsil::data-table.row') }}"
								x-effect="checked = !!selected['{{ $rowId }}']"
								x-on:click="checked = !checked; selected['{{ $rowId }}'] = checked; $event.stopPropagation()"
							/>
						</x-narsil::ui.table.table-cell>
					@endif
					@foreach ($columns as $column)
						@if (data_get($visible, $column['id'], $column['visibility'] ?? true))
							<x-narsil::ui.table.table-cell>
								{{ data_get($row, $column['accessorKey'] ?? $column['id']) }}
							</x-narsil::ui.table.table-cell>
						@endif
					@endforeach
					@if (data_get($routes, 'edit') || data_get($routes, 'destroy'))
						<x-narsil::ui.table.table-cell
							class="min-w-13 w-13 max-w-13 mask-l-from-85% mask-no-repeat sticky right-0 z-10"
						>
							<x-narsil::blocks.data-table.data-table-row-menu
								:id="$rowId"
								:parameters="$parameters"
								:routes="$routes"
							/>
						</x-narsil::ui.table.table-cell>
					@endif
				</x-narsil::ui.table.table-row>
			@empty
				<x-narsil::ui.table.table-row>
					<x-narsil::ui.table.table-cell
						class="h-24 text-center"
						colspan="{{ $columns->count() + 2 }}"
					>
						{{ trans('narsil::data-table.empty') }}
					</x-narsil::ui.table.table-cell>
				</x-narsil::ui.table.table-row>
			@endforelse
		</x-narsil::ui.table.table-body>
	</x-narsil::ui.table.table-root>
</x-narsil::ui.table.table-wrapper>

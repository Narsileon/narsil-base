@props(['payload'])
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
	$ids = collect($data)->map(fn($row) => (string) data_get($row, 'id', data_get($row, 'uuid')))->values()->all();
@endphp
<x-narsil::ui.table.wrapper
	class="min-h-0 grow"
>
	<x-narsil::ui.table.root
		class="min-w-max"
	>
		<x-narsil::ui.table.header>
			<x-narsil::ui.table.row
				class="bg-accent sticky top-0 z-10"
			>
				@if (data_get($meta, 'selectable', true) !== false)
					<x-narsil::ui.table.head
						class="w-9"
					>
						<input
							type="checkbox"
							x-on:change="selectAll($event.target.checked, @js($ids))"
						>
					</x-narsil::ui.table.head>
				@endif
				@foreach ($columns as $column)
					@if (data_get($visible, $column['id'], $column['visibility'] ?? true))
						<x-narsil::ui.table.head>
							<x-narsil::blocks.data-table.head-sort
								:column="$column"
								:payload="$payload"
							/>
						</x-narsil::ui.table.head>
					@endif
				@endforeach
				@if (data_get($routes, 'edit') || data_get($routes, 'destroy'))
					<x-narsil::ui.table.head
						class="w-12"
					/>
				@endif
			</x-narsil::ui.table.row>
		</x-narsil::ui.table.header>
		<x-narsil::ui.table.body>
			@forelse ($data as $row)
				@php $rowId = data_get($row, 'id', data_get($row, 'uuid')); @endphp
				<x-narsil::ui.table.row
					class="cursor-pointer"
				>
					@if (data_get($meta, 'selectable', true) !== false)
						<x-narsil::ui.table.cell>
							<input
								type="checkbox"
								x-on:change="select('{{ $rowId }}', $event.target.checked)"
								x-on:click.stop
							>
						</x-narsil::ui.table.cell>
					@endif
					@foreach ($columns as $column)
						@if (data_get($visible, $column['id'], $column['visibility'] ?? true))
							<x-narsil::ui.table.cell>
								{{ data_get($row, $column['accessorKey'] ?? $column['id']) }}
							</x-narsil::ui.table.cell>
						@endif
					@endforeach
					@if (data_get($routes, 'edit') || data_get($routes, 'destroy'))
						<x-narsil::ui.table.cell>
							<x-narsil::blocks.data-table.row-menu
								:id="$rowId"
								:parameters="$parameters"
								:routes="$routes"
							/>
						</x-narsil::ui.table.cell>
					@endif
				</x-narsil::ui.table.row>
			@empty
				<x-narsil::ui.table.row>
					<x-narsil::ui.table.cell
						class="h-24 text-center"
						colspan="{{ $columns->count() + 2 }}"
					>
						{{ trans('narsil::data-table.empty') }}
					</x-narsil::ui.table.cell>
				</x-narsil::ui.table.row>
			@endforelse
		</x-narsil::ui.table.body>
	</x-narsil::ui.table.root>
</x-narsil::ui.table.wrapper>

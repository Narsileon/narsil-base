
@php
	$meta = data_get($payload, 'meta', []);
	$state = data_get($meta, 'state', []);
	$uuid = data_get($state, 'uuid');
	$columns = collect(data_get($meta, 'columns', []))->map(
	    fn($column) => is_object($column) && method_exists($column, 'toArray') ? $column->toArray() : (array) $column,
	);
	$order = data_get($state, 'column_order', []);
	$columns = collect($order)
	    ->map(fn($id) => $columns->firstWhere('id', $id))
	    ->filter()
	    ->merge($columns->reject(fn($column) => in_array($column['id'], $order, true)));
	$visible = data_get($state, 'column_visibility', []);
@endphp

<x-narsil::ui.dropdown-menu.dropdown-menu-root>
	<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
		aria-label="{{ trans('narsil::ui.settings') }}"
		variant="secondary"
	>
		<x-narsil::ui.icon.icon-root
			name="settings"
		/>
	</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
	<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
		align="end"
	>
		<x-narsil::ui.dropdown-menu.dropdown-menu-popup
			class="border-none bg-transparent p-0 shadow-none ring-0"
		>
			<x-narsil::ui.card.card-root
				class="w-80"
			>
				<x-narsil::ui.card.card-header
					class="border-b"
				>
					<x-narsil::ui.card.card-title>
						{{ trans('narsil::data-table.columns') }}
					</x-narsil::ui.card.card-title>
					<x-narsil::ui.card.card-action>
						<button
							aria-label="{{ trans('narsil::ui.close') }}"
							class="hover:bg-accent inline-flex size-7 cursor-pointer items-center justify-center rounded-md transition-colors"
							type="button"
							x-on:click="open = false"
						>
							<x-narsil::ui.icon.icon-root
								name="x"
							/>
						</button>
					</x-narsil::ui.card.card-action>
				</x-narsil::ui.card.card-header>
				<x-narsil::ui.card.card-content
					class="max-h-96 gap-y-0 overflow-y-auto"
				>
					<div
						class="flex flex-col gap-1"
						x-sort="(item, position) => { order.splice(order.indexOf(item), 1); order.splice(position, 0, item); persist(); }"
					>
						@foreach ($columns as $index => $column)
							<div
								class="bg-background flex h-9 items-center gap-2 overflow-hidden rounded-md border pr-1"
								x-sort:item="{{ $column['id'] }}"
							>
								<button
									aria-label="{{ trans('narsil::ui.move') }} '{{ ucfirst($column['header'] ?? $column['id']) }}'"
									class="text-muted-foreground flex h-full w-7 cursor-grab items-center justify-center active:cursor-grabbing"
									type="button"
									x-sort:handle
								>
									<span
										aria-hidden="true"
									>⋮⋮</span>
								</button>
								<span
									class="grow truncate"
								>
									{{ ucfirst($column['header'] ?? $column['id']) }}
								</span>
								<x-narsil::blocks.switch.switch-root
									:checked="data_get($visible, $column['id'], $column['visibility'] ?? true)"
									name="column-{{ $column['id'] }}"
									x-on:change="toggleColumn('{{ $column['id'] }}')"
								/>
								<span
									class="flex gap-0.5"
								>
									<button
										@disabled($index === 0)
										aria-label="{{ trans('narsil::ui.move_up') }}"
										class="hover:bg-accent inline-flex size-7 cursor-pointer items-center justify-center rounded-md transition-colors disabled:pointer-events-none disabled:opacity-40"
										type="button"
										x-on:click="move('{{ $column['id'] }}', -1)"
									>
										<x-narsil::ui.icon.icon-root
											name="chevron-up"
										/>
									</button>
									<button
										@disabled($index === $columns->count() - 1)
										aria-label="{{ trans('narsil::ui.move_down') }}"
										class="hover:bg-accent inline-flex size-7 cursor-pointer items-center justify-center rounded-md transition-colors disabled:pointer-events-none disabled:opacity-40"
										type="button"
										x-on:click="move('{{ $column['id'] }}', 1)"
									>
										<x-narsil::ui.icon.icon-root
											name="chevron-down"
										/>
									</button>
								</span>
							</div>
						@endforeach
					</div>
				</x-narsil::ui.card.card-content>
				<x-narsil::ui.card.card-footer
					class="border-t"
				>
					@if ($uuid)
						<form
							action="{{ route('narsil.tables.destroy', $uuid) }}"
							class="w-full"
							method="POST"
						>
							@csrf
							@method('DELETE')
							<x-narsil::ui.button.button-root
								class="w-full"
								type="submit"
							>
								{{ trans('narsil::ui.reset') }}
							</x-narsil::ui.button.button-root>
						</form>
					@endif
				</x-narsil::ui.card.card-footer>
			</x-narsil::ui.card.card-root>
		</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
	</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
</x-narsil::ui.dropdown-menu.dropdown-menu-root>

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
				class="w-fit"
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
								<x-narsil::ui.sortable.sortable-handle
									aria-label="{{ trans('narsil::ui.move') }} '{{ ucfirst($column['header'] ?? $column['id']) }}'"
								>
								</x-narsil::ui.sortable.sortable-handle>
								<span
									class="grow truncate"
								>
									{{ ucfirst($column['header'] ?? $column['id']) }}
								</span>
								<x-narsil::blocks.switch.switch-root
									:checked="$visible[$column['id']] ?? $column['visibility'] ?? true"
									name="column-{{ $column['id'] }}"
									x-on:change="toggleColumn('{{ $column['id'] }}')"
								/>
								<span
									class="flex gap-0.5"
								>
					<x-narsil::ui.button.button-root
						:disabled="$index === 0"
						aria-label="{{ trans('narsil::ui.move_up') }}"
						class="size-7 rounded-md hover:bg-accent"
						size="icon"
						variant="ghost"
						x-on:click="move('{{ $column['id'] }}', -1)"
					>
						<x-narsil::ui.icon.icon-root
							class="size-4"
							name="chevron-up"
						/>
					</x-narsil::ui.button.button-root>
					<x-narsil::ui.button.button-root
						:disabled="$index === $columns->count() - 1"
						aria-label="{{ trans('narsil::ui.move_down') }}"
						class="size-7 rounded-md hover:bg-accent"
						size="icon"
						variant="ghost"
						x-on:click="move('{{ $column['id'] }}', 1)"
					>
						<x-narsil::ui.icon.icon-root
							class="size-4"
							name="chevron-down"
						/>
					</x-narsil::ui.button.button-root>
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

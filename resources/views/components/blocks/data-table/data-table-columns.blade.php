<x-narsil::ui.popover.popover-root>
	<x-narsil::blocks.tooltip.tooltip-root
		:tooltip="trans('narsil::ui.settings')"
	>
		<x-narsil::ui.popover.popover-trigger
			:as-child="true"
		>
			<x-narsil::ui.button.button-root
				aria-label="{{ trans('narsil::ui.settings') }}"
				variant="secondary"
			>
				<x-narsil::ui.icon.icon-root
					name="settings"
				/>
			</x-narsil::ui.button.button-root>
		</x-narsil::ui.popover.popover-trigger>
	</x-narsil::blocks.tooltip.tooltip-root>
	<x-narsil::ui.popover.popover-portal>
		<x-narsil::ui.popover.popover-positioner
			align="end"
		>
			<x-narsil::ui.popover.popover-popup
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
							<x-narsil::ui.button.button-root
								aria-label="{{ trans('narsil::ui.close') }}"
								size="icon-sm"
								variant="ghost"
								x-on:click="popoverOpen = false"
							>
								<x-narsil::ui.icon.icon-root
									class="size-4!"
									name="xmark"
								/>
							</x-narsil::ui.button.button-root>
						</x-narsil::ui.card.card-action>
					</x-narsil::ui.card.card-header>
					<x-narsil::ui.card.card-content
						class="max-h-96 gap-y-0 overflow-y-auto"
					>
						<x-narsil::ui.sortable-list.root>
							@foreach ($columns as $column)
								<div
									class="bg-background flex h-9 items-center gap-2 overflow-hidden rounded-md border pr-1"
									data-sortable-item="{{ $column['id'] }}"
									x-sort:item="@js((string) $column['id'])"
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
										:checked="$visible[$column['id']] ?? ($column['visibility'] ?? true)"
										name="column-{{ $column['id'] }}"
										x-on:change="toggleColumn('{{ $column['id'] }}')"
									/>
									<x-narsil::ui.sortable-item-menu.root
										:id="$column['id']"
									/>
								</div>
							@endforeach
						</x-narsil::ui.sortable-list.root>
					</x-narsil::ui.card.card-content>
					<x-narsil::ui.card.card-footer
						class="border-t"
					>
						<div
							class="flex w-full gap-2"
						>
							<x-narsil::ui.button.button-root
								class="flex-1"
								type="button"
								x-on:click.prevent="persist()"
							>
								{{ trans('narsil::ui.apply') }}
							</x-narsil::ui.button.button-root>
							@if ($uuid)
								<form
									action="{{ route('narsil.tables.destroy', $uuid) }}"
									class="flex-1"
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
						</div>
					</x-narsil::ui.card.card-footer>
				</x-narsil::ui.card.card-root>
			</x-narsil::ui.popover.popover-popup>
		</x-narsil::ui.popover.popover-positioner>
	</x-narsil::ui.popover.popover-portal>
</x-narsil::ui.popover.popover-root>

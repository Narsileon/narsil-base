@if ($activeFilters !== [])
	<ul
		class="flex flex-wrap items-center gap-2"
	>
		@foreach ($activeFilters as $filter)
			<li>
				<x-narsil::ui.popover.popover-root>
					<x-narsil::ui.popover.popover-trigger
						:as-child="true"
					>
						<x-narsil::ui.badge.badge-root
							class="cursor-pointer"
							role="button"
							tabindex="0"
							x-on:keydown.enter="$el.click()"
						>
							<span>{{ $filter['column'] }}</span>
							<span>{{ $filter['operator'] }}</span>
							<span>{{ $filter['value'] }}</span>
						</x-narsil::ui.badge.badge-root>
					</x-narsil::ui.popover.popover-trigger>
					<x-narsil::ui.popover.popover-portal>
						<x-narsil::ui.popover.popover-positioner
							align="start"
							side-offset="8"
						>
							<x-narsil::ui.popover.popover-popup
								class="border-none bg-transparent p-0 shadow-none ring-0"
							>
								<x-narsil::ui.card.card-root>
									<x-narsil::ui.card.card-header
										class="border-b"
									>
										<x-narsil::ui.card.card-title>
											{{ trans('narsil::data-table.filters') }}
										</x-narsil::ui.card.card-title>
										<x-narsil::ui.card.card-action>
											<x-narsil::ui.popover.popover-close-button
												size="icon-sm"
											/>
										</x-narsil::ui.card.card-action>
									</x-narsil::ui.card.card-header>
									<x-narsil::ui.card.card-content>
										<x-narsil::blocks.data-table.data-table-filter-form
											:filter="$filter"
											:payload="$payload"
										/>
									</x-narsil::ui.card.card-content>
								</x-narsil::ui.card.card-root>
							</x-narsil::ui.popover.popover-popup>
						</x-narsil::ui.popover.popover-positioner>
					</x-narsil::ui.popover.popover-portal>
				</x-narsil::ui.popover.popover-root>
			</li>
		@endforeach
	</ul>
@endif

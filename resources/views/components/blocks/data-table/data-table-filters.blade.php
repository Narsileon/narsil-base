<div
	class="flex flex-wrap items-center gap-2"
>
	<x-narsil::ui.popover.popover-root>
		<x-narsil::blocks.tooltip.tooltip-root
			:tooltip="trans('narsil::data-table.filters')"
		>
			<x-narsil::ui.popover.popover-trigger
				:as-child="true"
			>
				<x-narsil::ui.button.button-root
					aria-label="{{ trans('narsil::data-table.filters') }}"
					size="icon"
					variant="outline"
				>
					<x-narsil::ui.icon.icon-root
						name="filter"
					/>
				</x-narsil::ui.button.button-root>
			</x-narsil::ui.popover.popover-trigger>
		</x-narsil::blocks.tooltip.tooltip-root>
		<x-narsil::ui.popover.popover-portal>
			<x-narsil::ui.popover.popover-positioner
				align="end"
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
								:payload="$payload"
							/>
						</x-narsil::ui.card.card-content>
					</x-narsil::ui.card.card-root>
				</x-narsil::ui.popover.popover-popup>
			</x-narsil::ui.popover.popover-positioner>
		</x-narsil::ui.popover.popover-portal>
	</x-narsil::ui.popover.popover-root>
	@if ($activeFilters !== [])
		<ul
			class="flex flex-wrap items-center gap-2"
		>
			@foreach ($activeFilters as $filter)
				<li>
					<x-narsil::ui.badge.badge-root
						class="pr-0"
					>
						<span>{{ $filter['column'] }}</span>
						<span>{{ $filter['operator'] }}</span>
						<span>{{ $filter['value'] }}</span>
						<x-narsil::ui.badge.badge-close
							aria-label="{{ trans('narsil::ui.remove') }}"
							x-on:click="window.location.href = '{{ $filter['remove_url'] }}'"
						/>
					</x-narsil::ui.badge.badge-root>
				</li>
			@endforeach
		</ul>
	@endif
</div>

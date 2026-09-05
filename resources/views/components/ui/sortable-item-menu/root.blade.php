<div
	class="flex items-center"
>
	<x-narsil::blocks.tooltip.tooltip-root
		:tooltip="trans('narsil::ui.menu')"
	>
		<x-narsil::ui.dropdown-menu.dropdown-menu-root>
			<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
				aria-label="{{ trans('narsil::ui.menu') }}"
				size="icon-sm"
				variant="ghost-secondary"
			>
				<x-narsil::ui.icon.icon-root
					name="more-horizontal"
				/>
			</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
			<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
				<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
					align="end"
				>
					<x-narsil::ui.dropdown-menu.dropdown-menu-popup
						x-on:click.stop="$event.stopPropagation()"
					>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							data-sortable-item="{{ $id }}"
							x-bind:data-disabled="order.indexOf($el.dataset.sortableItem) === 0"
							x-on:click="$dispatch('sortable-list-move', { id: $el.dataset.sortableItem, direction: -1 }); dropdownOpen = false"
						>
							<x-narsil::ui.icon.icon-root
								name="move-up"
							/>
							{{ trans('narsil::ui.move_up') }}
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							data-sortable-item="{{ $id }}"
							x-bind:data-disabled="order.indexOf($el.dataset.sortableItem) === order.length - 1"
							x-on:click="$dispatch('sortable-list-move', { id: $el.dataset.sortableItem, direction: 1 }); dropdownOpen = false"
						>
							<x-narsil::ui.icon.icon-root
								name="move-down"
							/>
							{{ trans('narsil::ui.move_down') }}
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
					</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
				</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
			</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
		</x-narsil::ui.dropdown-menu.dropdown-menu-root>
	</x-narsil::blocks.tooltip.tooltip-root>
</div>

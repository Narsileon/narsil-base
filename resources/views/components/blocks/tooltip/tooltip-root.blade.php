<x-narsil::ui.tooltip.tooltip-provider
	:delay="$delay"
>
	<x-narsil::ui.tooltip.tooltip-root>
		<x-narsil::ui.tooltip.tooltip-trigger>
			{{ $slot }}
		</x-narsil::ui.tooltip.tooltip-trigger>
		<x-narsil::ui.tooltip.tooltip-portal>
			<x-narsil::ui.tooltip.tooltip-positioner
				:side-offset="$sideOffset"
				:side="$side"
			>
				<x-narsil::ui.tooltip.tooltip-popup>
					{{ $tooltip }}
					<x-narsil::ui.tooltip.tooltip-arrow />
				</x-narsil::ui.tooltip.tooltip-popup>
			</x-narsil::ui.tooltip.tooltip-positioner>
		</x-narsil::ui.tooltip.tooltip-portal>
	</x-narsil::ui.tooltip.tooltip-root>
</x-narsil::ui.tooltip.tooltip-provider>

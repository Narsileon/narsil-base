@props(['tooltip', 'delay' => 300, 'side' => 'top', 'sideOffset' => 4])

<x-narsil::ui.tooltip.provider :delay="$delay">
	<x-narsil::ui.tooltip.root>
		<x-narsil::ui.tooltip.trigger>
			{{ $slot }}
		</x-narsil::ui.tooltip.trigger>
		<x-narsil::ui.tooltip.portal>
			<x-narsil::ui.tooltip.positioner
				:side="$side"
				:side-offset="$sideOffset"
			>
				<x-narsil::ui.tooltip.popup>
					{{ $tooltip }}
					<x-narsil::ui.tooltip.arrow />
				</x-narsil::ui.tooltip.popup>
			</x-narsil::ui.tooltip.positioner>
		</x-narsil::ui.tooltip.portal>
	</x-narsil::ui.tooltip.root>
</x-narsil::ui.tooltip.provider>

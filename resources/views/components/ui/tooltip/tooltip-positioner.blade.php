<div
	{{ $attributes->twMerge('z-50') }}
	data-slot="tooltip-positioner"
	x-anchor.{{ $side }}.offset.{{ (int) $sideOffset }}="$refs['tooltip-trigger']"
	x-effect="$anchor.x; $anchor.y; positionArrow()"
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('absolute -bottom-1 left-1/2 size-2.5 -translate-x-1/2 rotate-45 rounded-[2px] bg-foreground') }}
	data-slot="tooltip-arrow"
	x-ref="tooltip-arrow"
	x-init="requestAnimationFrame(() => requestAnimationFrame(() => positionArrow()))"
>
	{{ $slot }}
</div>

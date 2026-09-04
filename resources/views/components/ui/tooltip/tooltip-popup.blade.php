<div
	{{ $attributes->twMerge('z-50 w-fit max-w-xs rounded-md bg-foreground px-3 py-1.5 text-xs text-background') }}
	data-slot="tooltip-content"
	x-cloak
	x-show="open"
	x-transition.opacity
>
	{{ $slot }}
</div>

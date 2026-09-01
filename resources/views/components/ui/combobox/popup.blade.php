<div
	{{ $attributes->twMerge('group/combobox-popup relative max-h-72 min-w-36 overflow-hidden rounded-lg bg-popover text-popover-foreground shadow-md ring-1 ring-foreground/10')->merge(['data-slot' => 'combobox-popup']) }}
	x-cloak
	x-on:click.outside="open = false"
	x-show="open"
	x-transition.origin.top
>
	{{ $slot }}
</div>

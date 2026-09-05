<div
	{{ $attributes->twMerge('z-50 flex w-72 flex-col gap-2.5 rounded-lg border bg-popover p-2.5 text-sm text-popover-foreground shadow-md outline-hidden') }}
	data-slot="popover-popup"
	x-cloak
	x-on:click.outside="popoverOpen = false"
	x-on:keydown.escape.window="popoverOpen = false"
	x-show="popoverOpen"
	x-transition.origin.top
>
	{{ $slot }}
</div>

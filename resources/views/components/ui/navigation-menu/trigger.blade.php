@props(['value' => null])

<button
	{{ $attributes->twMerge('group/navigation-menu-trigger inline-flex h-9 w-max items-center justify-center rounded-lg bg-background px-2.5 py-1.5 font-medium ring-2 ring-transparent transition-all outline-none data-open:bg-muted/50 data-open:focus:bg-muted data-open:hover:bg-muted disabled:pointer-events-none disabled:opacity-50 focus-visible:ring-primary focus:bg-muted focus-visible:ring-[3px] hover:bg-muted') }}
	data-slot="navigation-menu-trigger"
	type="button"
	x-bind:data-open="menuOpen === @js($value) ? '' : null"
	x-on:click="menuOpen = menuOpen === @js($value) ? null : @js($value)"
>
	{{ $slot }}
</button>

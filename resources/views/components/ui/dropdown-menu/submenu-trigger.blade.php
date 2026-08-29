@props(['inset' => false])

<button
	{{ $attributes->twMerge(
	        'flex cursor-default items-center gap-1.5 rounded-md px-1.5 py-1 text-sm outline-hidden select-none data-open:bg-accent data-open:text-accent-foreground focus:bg-accent focus:text-accent-foreground' .
	            ($inset ? ' pl-8' : ''),
	    )->merge([
	        'data-slot' => 'dropdown-menu-submenu-trigger',
	        'type' => 'button',
	    ]) }}
	@if ($inset) data-inset="true" @endif
	x-on:click="open = !open"
>
	{{ $slot }}
</button>

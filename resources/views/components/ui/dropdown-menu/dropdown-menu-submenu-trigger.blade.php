<button
	{{ $attributes->twMerge(
	        'flex cursor-default items-center gap-1.5 rounded-md px-3 py-1 outline-hidden select-none data-open:bg-accent data-open:text-accent-foreground focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground' .
	            ($inset ? ' pl-8' : ''),
	    )->merge([
	        'data-slot' => 'dropdown-menu-submenu-trigger',
	        'type' => 'button',
	    ]) }}
	@if ($inset) data-inset="true" @endif
	x-on:click="dropdownSubmenuOpen = true"
	x-on:mouseenter="dropdownSubmenuOpen = true"
>
	{{ $slot }}
</button>

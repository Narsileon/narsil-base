<div
	{{ $attributes->twMerge(
	        'z-50 flex min-w-fit flex-col gap-0.5 overflow-x-hidden overflow-y-auto rounded-lg bg-popover p-1.5 text-popover-foreground shadow-md ring-1 ring-foreground/10 outline-none',
	    )->merge([
	        'data-slot' => 'dropdown-menu-submenu-popup',
	        'role' => 'menu',
	        'x-on:mouseleave' => 'dropdownSubmenuOpen = false',
	    ]) }}
	x-cloak
	x-on:click.outside="dropdownSubmenuOpen = false"
	x-on:keydown.escape.window="dropdownSubmenuOpen = false"
	x-show="dropdownSubmenuOpen"
	x-transition.origin.top.left
>
	{{ $slot }}
</div>

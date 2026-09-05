<div
	{{ $attributes->twMerge(
	        'z-50 flex min-w-fit flex-col gap-0.5 overflow-x-hidden overflow-y-auto rounded-lg bg-popover p-1.5 text-popover-foreground shadow-md ring-1 ring-foreground/10 outline-none',
	    )->merge([
	        'data-slot' => 'dropdown-menu-popup',
	        'role' => 'menu',
	    ]) }}
	x-cloak
	x-on:click.outside="dropdownOpen = false"
	x-on:keydown.escape.window="dropdownOpen = false"
	x-show="dropdownOpen"
	x-transition.origin.top.left
>
	{{ $slot }}
</div>

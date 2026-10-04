<div
	{{ $attributes->twMerge()->merge([
	    'data-slot' => 'dropdown-menu-submenu-root',
	]) }}
	x-data="narsilDropdownMenuSubmenu()"
	x-on:dropdown-menu-close.window="dropdownSubmenuOpen = false"
>
	{{ $slot }}
</div>

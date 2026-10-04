<div
	{{ $attributes->twMerge('isolate z-50 outline-none')->merge([
	    'data-slot' => 'dropdown-menu-submenu-positioner',
	]) }}
	x-anchor.right-start.offset.4.fixed="getDropdownSubmenuAnchor($el)"
>
	{{ $slot }}
</div>

<div
	{{ $attributes->merge(['data-slot' => 'dropdown-menu-submenu-root']) }}
	x-data="{ dropdownSubmenuOpen: false }"
>
	{{ $slot }}
</div>

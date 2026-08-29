<div
	{{ $attributes->merge(['data-slot' => 'dropdown-menu-submenu-root']) }}
	x-data="{ open: false }"
>
	{{ $slot }}
</div>

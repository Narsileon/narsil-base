<div
	{{ $attributes->merge(['data-slot' => 'context-menu-submenu-root']) }}
	x-data="{ contextMenuSubmenuOpen: false }"
>
	{{ $slot }}
</div>

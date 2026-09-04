<div
	{{ $attributes->merge(['data-slot' => 'context-menu-submenu-root']) }}
	x-data="{ open: false }"
>
	{{ $slot }}
</div>

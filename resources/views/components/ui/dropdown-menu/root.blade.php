<div
	{{ $attributes->merge(['data-slot' => 'dropdown-menu-root']) }}
	x-data="{ open: false }"
	x-on:dropdown-menu-close="open = false"
	x-on:dropdown-menu-open="open = true"
>
	{{ $slot }}
</div>

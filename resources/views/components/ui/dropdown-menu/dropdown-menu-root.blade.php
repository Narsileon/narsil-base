<div
	{{ $attributes->merge(['data-slot' => 'dropdown-menu-root']) }}
	x-data="{ dropdownOpen: false }"
	x-on:dropdown-menu-close.window="dropdownOpen = false"
	x-on:dropdown-menu-open="dropdownOpen = true"
>
	{{ $slot }}
</div>

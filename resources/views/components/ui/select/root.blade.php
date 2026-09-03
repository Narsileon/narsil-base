<div
	{{ $attributes->twMerge('relative')->merge(['data-slot' => 'select-root']) }}
	x-on:dialog-close.window="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') $store.narsilDropdown.close(dropdownId); open = false"
	x-effect="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') open = $store.narsilDropdown.active === dropdownId"
>
	{{ $slot }}
</div>

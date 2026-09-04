<div
	{{ $attributes->twMerge('relative')->merge(['data-slot' => 'select-root']) }}
	x-effect="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') open = $store.narsilDropdown.active === dropdownId"
	x-on:dialog-close.window="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') $store.narsilDropdown.close(dropdownId); open = false"
>
	{{ $slot }}
</div>

<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex items-center justify-center')->merge([
	    'data-slot' => 'dropdown-menu-radio-item-indicator',
	]) }}
>
	{{ $slot }}
</span>

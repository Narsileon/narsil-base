<span
	{{ $attributes->twMerge('pointer-events-none absolute right-2 flex items-center justify-center')->merge([
	        'data-slot' => 'dropdown-menu-checkbox-item-indicator',
	    ]) }}
>
	{{ $slot }}
</span>

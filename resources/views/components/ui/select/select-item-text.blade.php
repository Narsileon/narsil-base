<span
	{{ $attributes->twMerge('flex flex-1 shrink-0 gap-2 whitespace-nowrap')->merge([
	    'data-slot' => 'select-item-text',
	]) }}
>
	{{ $slot }}
</span>

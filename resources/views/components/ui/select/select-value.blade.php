<span
	{{ $attributes->twMerge('flex flex-1 text-left')->merge([
	    'data-slot' => 'select-value',
	]) }}
>
	{{ $slot }}
</span>

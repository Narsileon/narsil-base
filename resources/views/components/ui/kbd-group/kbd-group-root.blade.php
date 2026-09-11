<div
	{{ $attributes->twMerge('flex items-center')->merge([
	    'data-slot' => 'kbd-group-root',
	]) }}
>
	{{ $slot }}
</div>

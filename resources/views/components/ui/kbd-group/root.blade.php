<div
	{{ $attributes->twMerge('flex items-center')->merge([
	    'data-slot' => 'kbd-group',
	]) }}
>
	{{ $slot }}
</div>

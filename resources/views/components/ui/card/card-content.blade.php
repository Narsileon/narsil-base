<div
	{{ $attributes->twMerge('grid gap-4 p-4')->merge([
	    'data-slot' => 'card-content',
	]) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('flex items-center gap-2')->merge([
	    'data-slot' => 'item-actions',
	]) }}
>
	{{ $slot }}
</div>

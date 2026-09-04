<div
	{{ $attributes->twMerge('flex basis-full items-center justify-between gap-2')->merge([
	    'data-slot' => 'item-header',
	]) }}
>
	{{ $slot }}
</div>

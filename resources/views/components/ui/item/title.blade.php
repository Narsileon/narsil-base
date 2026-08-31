<div
	{{ $attributes->twMerge('line-clamp-1 flex w-fit items-center gap-2 text-sm leading-snug font-medium underline-offset-4')->merge([
	        'data-slot' => 'item-title',
	    ]) }}
>
	{{ $slot }}
</div>

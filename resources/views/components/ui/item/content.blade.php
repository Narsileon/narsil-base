<div
	{{ $attributes->twMerge(
	        'flex flex-1 flex-col gap-4 group-data-[size=xs]/item:gap-2 [&+[data-slot=item-content]]:flex-none',
	    )->merge([
	        'data-slot' => 'item-content',
	    ]) }}
>
	{{ $slot }}
</div>

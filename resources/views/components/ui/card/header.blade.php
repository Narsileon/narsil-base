<div
	{{ $attributes->twMerge(
	        '@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start px-4 pt-2 [.border-b]:pb-2 has-data-[slot=card-action]:grid-cols-[1fr_auto] has-[data-slot=card-description]:*:data-[slot=card-action]:row-span-2',
	    )->merge([
	        'data-slot' => 'card-header',
	    ]) }}
>
	{{ $slot }}
</div>

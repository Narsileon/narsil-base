<div
	{{ $attributes->twMerge(
	        'group/avatar-group flex -space-x-2 *:data-[slot=avatar]:ring-2 *:data-[slot=avatar]:ring-background',
	    )->merge([
	        'data-slot' => 'avatar-group',
	    ]) }}
>
	{{ $slot }}
</div>

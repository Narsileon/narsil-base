<div
	{{ $attributes->twMerge('group/item-group flex w-full flex-col gap-4 has-data-[size=sm]:gap-2.5 has-data-[size=xs]:gap-2')->merge([
	        'data-slot' => 'item-group',
	        'role' => 'list',
	    ]) }}
>
	{{ $slot }}
</div>

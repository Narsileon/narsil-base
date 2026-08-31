<div
	{{ $attributes->twMerge('col-start-2 row-span-1 row-start-1 self-start justify-self-end')->merge([
	    'data-slot' => 'card-action',
	]) }}
>
	{{ $slot }}
</div>

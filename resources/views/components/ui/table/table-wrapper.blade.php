<div
	{{ $attributes->twMerge('overflow-x-auto rounded-md border shadow')->merge([
	    'data-slot' => 'table-wrapper',
	]) }}
>
	{{ $slot }}
</div>

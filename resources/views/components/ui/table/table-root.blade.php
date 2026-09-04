<table
	{{ $attributes->twMerge('w-full caption-bottom overflow-x-scroll')->merge([
	    'data-slot' => 'table-root',
	]) }}
>
	{{ $slot }}
</table>

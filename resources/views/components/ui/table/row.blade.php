<tr
	{{ $attributes->twMerge('h-11 border-b bg-background transition-colors hover:bg-accent')->merge([
	        'data-slot' => 'table-row',
	    ]) }}
>
	{{ $slot }}
</tr>

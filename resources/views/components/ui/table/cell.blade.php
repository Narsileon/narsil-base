<td
	{{ $attributes->twMerge(
	        'h-9 bg-inherit px-3 align-middle whitespace-nowrap *:[[role=checkbox]]:translate-y-0.5',
	    )->merge([
	        'data-slot' => 'table-cell',
	    ]) }}
>
	{{ $slot }}
</td>

<th
	{{ $attributes->twMerge(
	        'h-9 bg-inherit px-3 text-left align-middle font-medium whitespace-nowrap *:[[role=checkbox]]:translate-y-0.5',
	    )->merge([
	        'data-slot' => 'table-head',
	    ]) }}
>
	{{ $slot }}
</th>

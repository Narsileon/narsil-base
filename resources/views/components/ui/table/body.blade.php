<tbody
	{{ $attributes->twMerge('[&_tr:last-child]:border-0')->merge([
	    'data-slot' => 'table-body',
	]) }}
>
	{{ $slot }}
</tbody>

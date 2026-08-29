<tfoot
	{{ $attributes->twMerge('border-t bg-muted/50 font-medium [&>tr]:last:border-b-0')->merge([
	    'data-slot' => 'table-footer',
	]) }}
>
	{{ $slot }}
</tfoot>

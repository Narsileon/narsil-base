<caption
	{{ $attributes->twMerge('mt-4 text-muted-foreground')->merge([
	    'data-slot' => 'table-caption',
	]) }}
>
	{{ $slot }}
</caption>

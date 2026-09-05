<div
	{{ $attributes->twMerge('px-1.5 py-1 text-xs text-muted-foreground')->merge([
	    'data-slot' => 'select-group-label',
	]) }}
>
	{{ $slot }}
</div>

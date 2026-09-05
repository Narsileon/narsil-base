<div
	{{ $attributes->twMerge('px-2 py-1.5 text-xs text-muted-foreground')->merge([
	    'data-slot' => 'combobox-group-label',
	]) }}
>
	{{ $slot }}
</div>

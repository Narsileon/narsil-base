<div
	{{ $attributes->twMerge('px-1.5 py-1 text-xs font-medium text-muted-foreground')->merge([
	    'data-inset' => $inset,
	    'data-slot' => 'context-menu-group-label',
	]) }}
>
	{{ $slot }}
</div>

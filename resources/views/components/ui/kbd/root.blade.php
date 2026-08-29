<kbd
	{{ $attributes->twMerge(
	        'pointer-events-none inline-flex h-5 w-fit min-w-5 items-center justify-center gap-1 rounded-sm bg-muted px-1 text-xs font-medium text-muted-foreground select-none',
	    )->merge([
	        'data-slot' => 'kbd',
	    ]) }}
>
	{{ $slot }}
</kbd>

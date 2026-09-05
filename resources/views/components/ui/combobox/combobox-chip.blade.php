<span
	{{ $attributes->twMerge(
	        'flex h-7 w-fit items-center justify-center gap-1 rounded-sm bg-muted px-1.5 text-xs font-medium whitespace-nowrap text-foreground',
	    )->merge([
	        'data-slot' => 'combobox-chip',
	    ]) }}
>
	{{ $slot }}
</span>

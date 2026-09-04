
<input
	{{ $attributes->twMerge(
	        'h-9 w-full min-w-0 rounded-lg border bg-accent/50 px-2.5 py-1 text-sm/7 transition-colors outline-none aria-invalid:border-destructive aria-invalid:ring-[3px] aria-invalid:ring-destructive/20 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 file:inline-flex file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground focus-visible:shine-border placeholder:text-muted-foreground',
	    )->merge([
	        'data-slot' => 'input',
	        'type' => $type,
	    ]) }}
>

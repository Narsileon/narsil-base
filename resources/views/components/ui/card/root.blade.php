<div
	{{ $attributes->twMerge(
	        'relative z-10 flex flex-col overflow-hidden rounded-xl border bg-card text-card-foreground shadow-sm',
	    )->merge([
	        'data-slot' => 'card-root',
	    ]) }}
>
	{{ $slot }}
</div>

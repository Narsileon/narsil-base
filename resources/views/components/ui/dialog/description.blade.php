<div
	{{ $attributes->twMerge(
	        'text-sm text-muted-foreground *:[a]:underline *:[a]:underline-offset-3 *:[a]:hover:text-foreground',
	    )->merge([
	        'data-slot' => 'dialog-description',
	    ]) }}
>
	{{ $slot }}
</div>

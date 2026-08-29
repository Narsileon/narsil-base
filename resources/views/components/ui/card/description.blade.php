<div
	{{ $attributes->twMerge('text-muted-foreground')->merge([
	    'data-slot' => 'card-description',
	]) }}
>
	{{ $slot }}
</div>

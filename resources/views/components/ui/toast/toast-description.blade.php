<p
	{{ $attributes->twMerge('line-clamp-2 text-left leading-normal font-normal text-muted-foreground')->merge([
	        'data-slot' => 'toast-description',
	    ]) }}
>
	{{ $slot }}
</p>

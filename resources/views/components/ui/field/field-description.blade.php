<p
	{{ $attributes->twMerge('text-left leading-normal font-normal text-muted-foreground')->merge([
	    'data-slot' => 'field-description',
	]) }}
>
	{{ $slot }}
</p>

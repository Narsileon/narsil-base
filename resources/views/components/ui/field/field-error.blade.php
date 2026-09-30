<p
	{{ $attributes->twMerge(' text-destructive')->merge([
	    'data-slot' => 'field-error',
	    'role' => 'alert',
	]) }}
>
	{{ $slot }}
</p>

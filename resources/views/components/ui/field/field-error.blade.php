<p
	{{ $attributes->twMerge('text-sm text-destructive')->merge([
	    'data-slot' => 'field-error',
	    'role' => 'alert',
	]) }}
>
	{{ $slot }}
</p>

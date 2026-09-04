<div
	{{ $attributes->twMerge('flex')->merge([
	    'data-slot' => 'accordion-header',
	]) }}
>
	{{ $slot }}
</div>

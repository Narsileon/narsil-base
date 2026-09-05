<div
	{{ $attributes->twMerge('overflow-hidden transition-opacity')->merge([
	    'data-slot' => 'toast-content',
	]) }}
>
	{{ $slot }}
</div>

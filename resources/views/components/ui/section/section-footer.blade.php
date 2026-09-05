<div
	{{ $attributes->twMerge('flex items-center [.border-t]:pt-3')->merge([
	    'data-slot' => 'section-footer',
	]) }}
>
	{{ $slot }}
</div>

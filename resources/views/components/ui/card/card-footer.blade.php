<div
	{{ $attributes->twMerge('flex items-center px-4 pb-2 [.border-t]:pt-2')->merge([
	    'data-slot' => 'card-footer',
	]) }}
>
	{{ $slot }}
</div>

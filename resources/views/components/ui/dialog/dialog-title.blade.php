<h2
	{{ $attributes->twMerge('text-base leading-none font-medium')->merge([
	    'data-slot' => 'dialog-title',
	]) }}
>
	{{ $slot }}
</h2>

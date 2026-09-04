<div
	{{ $attributes->twMerge('h-9 content-center leading-none font-semibold')->merge([
	    'data-slot' => 'card-title',
	]) }}
>
	{{ $slot }}
</div>

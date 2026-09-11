<div
	{{ $attributes->twMerge('fixed inset-0 isolate z-50 duration-100 supports-backdrop-filter:backdrop-blur-xs')->merge([
	    'data-slot' => 'backdrop-root',
	]) }}
>
	{{ $slot }}
</div>

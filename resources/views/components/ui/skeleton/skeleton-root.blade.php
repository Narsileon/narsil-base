<div
	{{ $attributes->twMerge('animate-pulse rounded-md bg-muted')->merge([
	    'data-slot' => 'skeleton-root',
	]) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('relative aspect-(--ratio)')->merge([
	    'data-slot' => 'aspect-ratio',
	    'style' => "--ratio: {$ratio}",
	]) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('flex h-fit items-center justify-between [.border-b]:pb-3')->merge([
	    'data-slot' => 'section-header',
	]) }}
>
	{{ $slot }}
</div>

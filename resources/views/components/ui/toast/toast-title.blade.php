<div
	{{ $attributes->twMerge('line-clamp-1 flex w-fit items-center gap-2 leading-snug font-medium')->merge([
	    'data-slot' => 'toast-title',
	]) }}
>
	{{ $slot }}
</div>

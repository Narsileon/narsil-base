<div
	{{ $attributes->twMerge('flex w-fit items-center gap-2 leading-snug font-medium')->merge([
	    'data-slot' => 'field-title',
	]) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('line-clamp-1 flex w-fit items-center gap-2 text-sm leading-snug font-medium')->merge(['data-slot' => 'toast-title']) }}
>
	{{ $slot }}
</div>

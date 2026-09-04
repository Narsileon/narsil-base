<div
	{{ $attributes->twMerge('flex h-13 shrink-0 items-center gap-2 px-4 pt-2 [.border-b]:pb-2')->merge([
	    'data-slot' => 'dialog-header',
	]) }}
>
	{{ $slot }}
</div>

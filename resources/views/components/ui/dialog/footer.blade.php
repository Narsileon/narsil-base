<div
	{{ $attributes->twMerge(
	        'flex h-13 flex-col-reverse gap-2 px-4 pb-2 sm:flex-row sm:justify-end [.border-t]:pt-2',
	    )->merge([
	        'data-slot' => 'dialog-footer',
	    ]) }}
>
	{{ $slot }}
</div>

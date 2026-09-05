<div
	{{ $attributes->twMerge('fixed right-4 bottom-4 z-[1000] mx-auto flex w-62 flex-col gap-3 sm:right-8 sm:bottom-8 sm:w-75')->merge([
	        'data-slot' => 'toast-viewport',
	    ]) }}
>
	{{ $slot }}
</div>

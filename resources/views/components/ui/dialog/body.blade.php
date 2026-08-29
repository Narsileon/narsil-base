<div
	{{ $attributes->twMerge('grid w-full gap-4 overflow-hidden overflow-y-auto p-4 text-center sm:text-left')->merge([
	        'data-slot' => 'dialog-body',
	    ]) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge(
	        'absolute right-0 bottom-0 left-auto mr-0 w-full origin-bottom rounded-lg border bg-popover text-popover-foreground shadow-lg',
	    )->merge([
	        'data-slot' => 'toast-root',
	    ]) }}
	x-data="{ toastOpen: true }"
	x-show="toastOpen"
	x-transition
>
	{{ $slot }}
</div>

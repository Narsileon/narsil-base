<button
	{{ $attributes->twMerge(
	        'flex cursor-pointer items-center rounded-sm px-1.5 py-0.5  font-medium outline-hidden select-none hover:bg-muted aria-expanded:bg-muted',
	    )->merge([
	        'data-slot' => 'menubar-trigger',
	        'type' => 'button',
	    ]) }}
>
	{{ $slot }}
</button>

<div
	{{ $attributes->twMerge(
	        'group/menubar-item relative flex cursor-default items-center gap-1.5 rounded-md px-1.5 py-1 text-sm outline-hidden select-none data-disabled:pointer-events-none data-disabled:opacity-50 data-inset:pl-8 focus:bg-accent focus:text-accent-foreground',
	    )->merge([
	        'data-inset' => $inset,
	        'data-slot' => 'menubar-item',
	        'data-variant' => $variant,
	        'role' => 'menuitem',
	    ]) }}
>
	{{ $slot }}
</div>

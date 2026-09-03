<div
	{{ $attributes->twMerge('relative flex cursor-default items-center gap-1.5 rounded-md py-1 pr-1.5 pl-7 text-sm outline-hidden select-none data-disabled:pointer-events-none data-disabled:opacity-50 focus:bg-accent focus:text-accent-foreground')->merge(['data-slot' => 'menubar-radio-item', 'role' => 'menuitemradio']) }}
>
	{{ $slot }}
</div>

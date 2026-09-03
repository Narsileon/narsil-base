<div
	{{ $attributes->twMerge('z-50 min-w-36 overflow-x-hidden overflow-y-auto rounded-lg bg-popover p-1 text-popover-foreground shadow-md ring-1 ring-foreground/10 duration-100 outline-none data-closed:animate-out data-closed:fade-out-0 data-closed:zoom-out-95 data-open:animate-in data-open:fade-in-0 data-open:zoom-in-95')->merge(['data-slot' => 'menubar-popup']) }}
>
	{{ $slot }}
</div>

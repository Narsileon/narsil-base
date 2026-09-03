<button
	{{ $attributes->twMerge('inline-flex h-9 shrink-0 cursor-pointer items-center gap-2 rounded-md border border-transparent px-3 py-2 whitespace-nowrap text-foreground ring-2 ring-transparent transition-all outline-none disabled:pointer-events-none disabled:opacity-50 focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground data-active:bg-accent data-[orientation=horizontal]:justify-center data-[orientation=vertical]:justify-start data-[orientation=vertical]:w-full [&_svg]:pointer-events-none [&_svg]:shrink-0')->merge(['data-slot' => 'tabs-trigger', 'type' => 'button']) }}
>
	{{ $slot }}
</button>

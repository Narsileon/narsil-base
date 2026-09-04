<div
	{{ $attributes->twMerge('flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-muted-foreground transition-[margin,opacity] duration-300 group-data-[state=collapsed]:-z-10 group-data-[state=collapsed]:-mt-8 group-data-[state=collapsed]:opacity-0')->merge(['data-slot' => 'sidebar-group-label']) }}
>
	{{ $slot }}
</div>

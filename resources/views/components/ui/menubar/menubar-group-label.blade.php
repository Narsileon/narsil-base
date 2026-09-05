<div
	{{ $attributes->twMerge('px-1.5 py-1 text-sm font-medium text-muted-foreground data-inset:pl-8')->merge(['data-inset' => $inset, 'data-slot' => 'menubar-label']) }}
>
	{{ $slot }}
</div>

@php
	$classes = [
	    'group/item flex w-full flex-wrap items-center rounded-lg border text-sm ring-1 ring-transparent transition-all duration-300 outline-none focus-visible:border-primary focus-visible:ring-primary [a]:transition-colors [a]:hover:bg-muted',
	];

	$classes[] = match ($variant) {
	    'outline' => 'border-border',
	    'muted' => 'border-transparent bg-muted/50',
	    default => 'border-transparent',
	};

	$classes[] = match ($size) {
	    'xs' => 'gap-2 px-2.5 py-2 in-data-[slot=dropdown-menu-content]:p-0',
	    'sm' => 'gap-2.5 px-3 py-2.5',
	    default => 'gap-2.5 px-3 py-2.5',
	};
@endphp

<div
	{{ $attributes->twMerge(implode(' ', $classes))->merge(['data-size' => $size, 'data-slot' => 'item-root', 'data-variant' => $variant]) }}
>
	{{ $slot }}
</div>

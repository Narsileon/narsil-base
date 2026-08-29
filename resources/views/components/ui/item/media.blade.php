@props([
    'variant' => 'default',
])

@php
	$classes = [
	    'flex shrink-0 items-center justify-center gap-2 group-has-data-[slot=item-description]/item:translate-y-0.5 group-has-data-[slot=item-description]/item:self-start [&_svg]:pointer-events-none',
	];

	if ($variant === 'icon') {
	    $classes[] = '[&_svg:not([class*=\'size-\'])]:size-4';
	}

	if ($variant === 'image') {
	    $classes[] =
	        'size-10 overflow-hidden rounded-sm group-data-[size=sm]/item:size-8 group-data-[size=xs]/item:size-6 [&_img]:size-full [&_img]:object-cover';
	}
@endphp

<div
	{{ $attributes->twMerge(implode(' ', $classes))->merge([
	    'data-slot' => 'item-media',
	    'data-variant' => $variant,
	]) }}
>
	{{ $slot }}
</div>

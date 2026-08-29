@props([
    'level' => 'h1',
    'variant' => 'h6',
])

@php
	$classes = match ($variant) {
	    'h1' => 'text-4xl',
	    'h2' => 'text-3xl',
	    'h3' => 'text-2xl',
	    'h4' => 'text-xl',
	    'h5' => 'text-lg',
	    'discreet' => 'flex h-8 items-center text-xs font-medium text-muted-foreground',
	    default => 'text-base',
	};
@endphp

<{{ $level }}
	{{ $attributes->twMerge("font-medium tracking-tight text-foreground {$classes}")->merge([
	    'data-slot' => 'heading',
	]) }}
>
	{{ $slot }}
	</{{ $level }}>

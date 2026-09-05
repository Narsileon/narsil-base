@php
	$classes = [
	    'group/button inline-flex shrink-0 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent bg-clip-padding font-medium whitespace-nowrap ring-1 ring-transparent transition-all duration-300 outline-none select-none',
	    'aria-disabled:pointer-events-none aria-disabled:opacity-50',
	    'disabled:pointer-events-none disabled:opacity-50',
	    '[&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*=\'size-\'])]:size-4',
	];

	$classes[] = match ($variant) {
	    'outline'
	        => 'border-border bg-background focus-visible:border-primary focus-visible:bg-accent focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground',
	    default => 'bg-transparent',
	};

	$classes[] = match ($size) {
	    'sm' => 'h-7 gap-1.5 px-3 has-[>svg]:px-2',
	    'lg' => 'h-11 px-6 has-[>svg]:px-2',
	    default => 'size-9',
	};

	if ($active) {
	    $classes[] = 'bg-accent';
	}
@endphp

@if ($href && !$disabled)
	<a
		{{ $attributes->twMerge(implode(' ', $classes))->merge(['data-active' => $active, 'data-size' => $size, 'data-slot' => 'pagination-link', 'data-variant' => $variant, 'href' => $href]) }}
		aria-current="{{ $active ? 'page' : 'false' }}"
		wire:navigate
	>
		{{ $slot }}
	</a>
@else
	<button
		{{ $attributes->twMerge(implode(' ', $classes))->merge(['data-active' => $active, 'data-size' => $size, 'data-slot' => 'pagination-link', 'data-variant' => $variant, 'type' => 'button']) }}
		@disabled($disabled)
		aria-current="{{ $active ? 'page' : 'false' }}"
	>
		{{ $slot }}
	</button>
@endif

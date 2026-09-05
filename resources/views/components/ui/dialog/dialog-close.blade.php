@php
	$classes = [
	    'group/button inline-flex shrink-0 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent bg-clip-padding font-medium whitespace-nowrap ring-1 ring-transparent transition-all duration-300 outline-none select-none',
	    'aria-disabled:pointer-events-none aria-disabled:opacity-50',
	    'aria-invalid:border-destructive aria-invalid:ring-destructive/20',
	    'disabled:pointer-events-none disabled:opacity-50',
	    '[&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*=\'size-\'])]:size-4',
	];

	$classes[] = match ($variant) {
	    'destructive' => 'bg-destructive/80 text-destructive-foreground focus-visible:bg-destructive hover:bg-destructive',
	    'ghost' => 'focus-visible:border-primary focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground',
	    'outline'
	        => 'border-border bg-background focus-visible:border-primary focus-visible:bg-accent focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground',
	    'secondary'
	        => 'bg-secondary/80 text-secondary-foreground focus-visible:border-primary focus-visible:ring-primary hover:bg-secondary',
	    default
	        => 'bg-radial from-primary/80 to-primary text-primary-foreground focus-visible:bg-primary hover:from-primary/90 [&_svg]:text-primary-foreground',
	};

	$classes[] = match ($size) {
	    'icon' => 'size-9 rounded-full',
	    'icon-sm' => 'size-7 rounded-full p-1 [&>svg]:size-5',
	    'icon-xs' => 'size-5 rounded-full p-1 [&>svg]:size-3',
	    default => 'h-9 px-3 py-2 has-[>svg]:px-2',
	};
@endphp

<button
	{{ $attributes->twMerge(implode(' ', $classes))->merge([
	    'data-size' => $size,
	    'data-slot' => 'dialog-close',
	    'data-variant' => $variant,
	    'type' => 'button',
	]) }}
	x-on:click="$dispatch('dialog-close')"
>
	{{ $slot }}
</button>

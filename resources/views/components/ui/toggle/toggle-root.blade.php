
@php
	$classes = [
	    'group/toggle inline-flex shrink-0 items-center justify-center gap-1 rounded-md border border-transparent text-sm font-medium whitespace-nowrap ring-1 ring-transparent transition-all outline-none [&_svg:not([class*=\'size-\'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0 aria-invalid:border-destructive aria-invalid:ring-destructive/20 aria-pressed:bg-muted data-[state=on]:bg-muted disabled:pointer-events-none disabled:opacity-50 focus-visible:border-primary focus-visible:ring-primary hover:bg-muted hover:text-foreground',
	    $variant === 'outline' ? 'border-border bg-transparent' : 'bg-transparent',
	];
	$classes[] = match ($size) {
	    'sm' => 'h-8 min-w-8 px-1.5',
	    'lg' => 'h-10 min-w-10 px-2.5',
	    'icon' => 'size-9',
	    default => 'h-9 min-w-9 px-4',
	};
@endphp

<button
	{{ $attributes->twMerge(implode(' ', $classes))->merge(['data-size' => $size, 'data-slot' => 'toggle', 'data-state' => $pressed ? 'on' : 'off', 'data-variant' => $variant, 'type' => 'button']) }}
	aria-pressed="{{ $pressed ? 'true' : 'false' }}"
	x-bind:aria-pressed="pressed"
	x-bind:data-state="pressed ? 'on' : 'off'"
	x-data="{ pressed: @js((bool) $pressed) }"
	x-on:click="pressed = !pressed"
>
	{{ $slot }}
</button>

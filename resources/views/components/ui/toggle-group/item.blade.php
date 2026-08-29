@props([
    'size' => null,
    'value',
    'variant' => null,
])

@php
	$resolvedSize = $size ?: null;
	$resolvedVariant = $variant ?: null;
	$sizeClasses = match ($resolvedSize) {
	    'sm' => 'h-8 min-w-8 px-1.5',
	    'lg' => 'h-10 min-w-10 px-2.5',
	    'icon' => 'size-9',
	    default => 'h-9 min-w-9 px-4',
	};
	$variantClasses =
	    $resolvedVariant === 'outline' ? 'border-border bg-transparent' : 'bg-transparent';
@endphp

<button
	{{ $attributes->twMerge("group/toggle shrink-0 inline-flex items-center justify-center gap-1 rounded-md border border-transparent text-sm font-medium whitespace-nowrap ring-1 ring-transparent transition-all outline-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0 aria-pressed:bg-muted data-[state=on]:bg-muted disabled:pointer-events-none disabled:opacity-50 focus-visible:z-10 focus-visible:border-primary focus-visible:ring-primary hover:bg-muted hover:text-foreground group-data-[spacing=0]/toggle-group:px-2 group-data-[spacing=0]/toggle-group:rounded-none group-data-[orientation=horizontal]/toggle-group:data-[spacing=0]:first:rounded-l-md group-data-[orientation=horizontal]/toggle-group:data-[spacing=0]:last:rounded-r-md group-data-[orientation=vertical]/toggle-group:data-[spacing=0]:first:rounded-t-md group-data-[orientation=vertical]/toggle-group:data-[spacing=0]:last:rounded-b-md group-data-[variant=outline]/toggle-group:border-border {$sizeClasses} {$variantClasses} group-data-[size=sm]/toggle-group:h-8 group-data-[size=sm]/toggle-group:min-w-8 group-data-[size=sm]/toggle-group:px-1.5 group-data-[size=lg]/toggle-group:h-10 group-data-[size=lg]/toggle-group:min-w-10 group-data-[size=lg]/toggle-group:px-2.5 group-data-[size=icon]/toggle-group:size-9")->merge(['data-size' => $resolvedSize, 'data-slot' => 'toggle-group-item', 'data-state' => 'off', 'data-variant' => $resolvedVariant, 'type' => 'button']) }}
	aria-pressed="false"
	x-bind:aria-pressed="selected === @js($value)"
	x-bind:data-state="selected === @js($value) ? 'on' : 'off'"
	x-on:click="selected = @js($value); $dispatch('toggle-group-change', { value: @js($value) })"
>
	{{ $slot }}
</button>

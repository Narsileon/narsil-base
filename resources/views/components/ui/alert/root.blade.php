@props(['variant' => 'default'])

@php
	$classes = match ($variant) {
	    'destructive' => 'bg-card text-destructive *:data-[slot=alert-description]:text-destructive/90',
	    default => 'bg-card text-card-foreground',
	};
@endphp

<div
	{{ $attributes->twMerge("relative grid w-full grid-cols-[0_1fr] items-start gap-y-0.5 rounded-md border px-4 py-3 has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] has-[>svg]:gap-x-3 [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current {$classes}") }}
	data-slot="alert-root"
	data-variant="{{ $variant }}"
	role="alert"
>
	{{ $slot }}
</div>

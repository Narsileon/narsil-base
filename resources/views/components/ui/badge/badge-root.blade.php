@php
	$classes = match ($variant) {
	    'secondary' => 'bg-secondary text-secondary-foreground [a]:hover:bg-secondary/80',
	    'destructive' => 'bg-destructive/10 text-destructive focus-visible:ring-destructive [a]:hover:bg-destructive/20',
	    'ghost' => 'hover:bg-muted hover:text-muted-foreground dark:hover:bg-muted/50',
	    'link' => 'text-primary underline-offset-4 hover:underline',
	    'outline' => 'text-foreground [a&]:hover:bg-accent [a&]:hover:text-accent-foreground',
	    default => 'bg-primary text-primary-foreground [a]:hover:bg-primary/80',
	};
@endphp

<span
	{{ $attributes->twMerge(
	        "group/badge inline-flex h-5 w-fit shrink-0 items-center justify-center gap-1 overflow-hidden rounded-4xl border border-transparent px-2 py-0.5 text-xs font-medium whitespace-nowrap ring-1 ring-transparent transition-all [&>svg]:pointer-events-none [&>svg]:size-3! aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 focus-visible:border-primary focus-visible:ring-primary has-data-[icon=inline-end]:pr-1.5 has-data-[icon=inline-start]:pl-1.5 {$classes}",
	    )->merge([
	        'data-slot' => 'badge',
	        'data-variant' => $variant,
	    ]) }}
>
	{{ $slot }}
</span>

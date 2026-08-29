<textarea
    {{ $attributes->twMerge('flex field-sizing-content min-h-16 w-full rounded-md border bg-accent/50 px-3 py-2 shadow-sm outline-none placeholder:text-muted-foreground focus-visible:bg-accent')->merge(['data-slot' => 'textarea']) }}
>{{ $slot }}</textarea>

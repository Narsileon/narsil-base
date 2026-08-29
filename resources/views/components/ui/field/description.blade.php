<p
    {{ $attributes->twMerge('text-left text-sm leading-normal font-normal text-muted-foreground')->merge([
        'data-slot' => 'field-description',
    ]) }}
>
    {{ $slot }}
</p>

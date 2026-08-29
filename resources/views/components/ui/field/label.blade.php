@props(['required' => false])

<x-narsil::blocks.label.root
    {{ $attributes->twMerge('min-h-7 data-invalid:text-destructive')->merge([
        'data-slot' => 'field-label',
    ]) }}
    :required="$required"
>
    <span class="first-letter:uppercase">{{ $slot }}</span>
</x-narsil::blocks.label.root>

<section
    {{ $attributes->twMerge('flex flex-col gap-4')->merge(['data-slot' => 'section-root']) }}
>
    {{ $slot }}
</section>

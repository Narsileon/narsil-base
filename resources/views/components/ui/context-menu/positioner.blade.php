<div
    {{ $attributes->twMerge('fixed isolate z-50 outline-none')->merge(['data-slot' => 'context-menu-positioner']) }}
    :style="`left: ${x}px; top: ${y}px`"
>
    {{ $slot }}
</div>

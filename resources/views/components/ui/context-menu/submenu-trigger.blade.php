@props(['inset' => false])

<button
    {{ $attributes->twMerge('flex cursor-default items-center gap-1.5 rounded-md px-1.5 py-1 text-sm outline-hidden select-none data-open:bg-accent data-open:text-accent-foreground focus:bg-accent focus:text-accent-foreground')->merge(['data-inset' => $inset, 'data-slot' => 'context-menu-submenu-trigger', 'type' => 'button']) }}
    x-on:click="open = !open"
>
    {{ $slot }}
</button>

<button
    {{ $attributes->twMerge('relative flex cursor-default items-center gap-1.5 rounded-md py-1 pr-8 pl-1.5 text-sm outline-hidden select-none focus:bg-accent focus:text-accent-foreground')->merge(['data-slot' => 'context-menu-radio-item', 'role' => 'menuitemradio', 'type' => 'button']) }}
    x-on:click="$dispatch('context-menu-close')"
>
    {{ $slot }}
</button>

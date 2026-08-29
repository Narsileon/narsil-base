@props(['inset' => false, 'variant' => 'default'])

<button
    {{ $attributes->twMerge('group/context-menu-item relative flex w-full cursor-default items-center gap-1.5 rounded-md px-1.5 py-1 text-sm outline-hidden select-none [&_svg:not([class*=\'size-\'])]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0 data-disabled:pointer-events-none data-disabled:opacity-50 data-inset:pl-8 data-variant-destructive:text-destructive focus:bg-accent focus:text-accent-foreground')->merge(['data-inset' => $inset, 'data-slot' => 'context-menu-item', 'data-variant' => $variant, 'role' => 'menuitem', 'type' => 'button']) }}
    x-on:click="$dispatch('context-menu-close')"
>
    {{ $slot }}
</button>

<div
    {{ $attributes->twMerge('z-50 min-w-36 overflow-x-hidden overflow-y-auto rounded-lg bg-popover p-1 text-popover-foreground shadow-md ring-1 ring-foreground/10 outline-none')->merge(['data-slot' => 'context-menu-popup', 'role' => 'menu']) }}
    x-cloak
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
    x-show="open"
    x-transition.origin.top.left
>
    {{ $slot }}
</div>

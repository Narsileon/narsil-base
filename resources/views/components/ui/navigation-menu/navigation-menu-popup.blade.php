<div
	{{ $attributes->twMerge('relative rounded-lg bg-popover text-popover-foreground shadow ring-1 ring-foreground/10 transition-all duration-300 outline-none origin-(--transform-origin)') }}
	data-slot="navigation-menu-popup"
>
	{{ $slot }}
</div>

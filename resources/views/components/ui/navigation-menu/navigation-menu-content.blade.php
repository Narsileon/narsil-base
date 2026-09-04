
<div
	{{ $attributes->twMerge('h-full w-auto p-1 transition-[opacity,transform,translate] duration-300') }}
	data-slot="navigation-menu-content"
	x-show="menuOpen === @js($value)"
	x-transition.opacity
>
	{{ $slot }}
</div>

<div
	{{ $attributes->merge(['data-slot' => 'context-menu-root']) }}
	x-data="{ open: false, x: 0, y: 0 }"
	x-on:context-menu-close="open = false"
	x-on:contextmenu.prevent="x = $event.clientX; y = $event.clientY; open = true"
>
	{{ $slot }}
</div>

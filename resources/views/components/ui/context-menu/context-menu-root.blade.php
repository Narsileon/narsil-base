<div
	{{ $attributes->merge([
	    'data-slot' => 'context-menu-root',
	]) }}
	x-data="{ contextMenuOpen: false, contextMenuX: 0, contextMenuY: 0 }"
	x-on:context-menu-close="contextMenuOpen = false"
	x-on:contextmenu.prevent="contextMenuX = $event.clientX; contextMenuY = $event.clientY; contextMenuOpen = true"
>
	{{ $slot }}
</div>

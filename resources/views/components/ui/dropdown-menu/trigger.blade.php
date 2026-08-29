<button
	{{ $attributes->twMerge('cursor-pointer')->merge([
	    'data-slot' => 'dropdown-menu-trigger',
	    'type' => 'button',
	]) }}
	aria-haspopup="menu"
	x-bind:aria-expanded="open"
	x-on:click="open = !open"
	x-ref="trigger"
>
	{{ $slot }}
</button>

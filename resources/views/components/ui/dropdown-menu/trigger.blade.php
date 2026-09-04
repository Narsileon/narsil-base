<button
	{{ $attributes->twMerge('cursor-pointer [&_svg]:size-4 [&_svg]:pointer-events-none [&_svg]:shrink-0')->merge([
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

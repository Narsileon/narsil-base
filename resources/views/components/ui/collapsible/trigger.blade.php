<button
	{{ $attributes->merge(['data-slot' => 'collapsible-trigger', 'type' => 'button']) }}
	x-bind:aria-expanded="open"
	x-on:click="open = !open"
>
	{{ $slot }}
</button>

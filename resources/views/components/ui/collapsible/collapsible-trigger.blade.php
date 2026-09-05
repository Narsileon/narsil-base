<button
	{{ $attributes->merge(['data-slot' => 'collapsible-trigger', 'type' => 'button']) }}
	x-bind:aria-expanded="collapsibleOpen"
	x-on:click="collapsibleOpen = !collapsibleOpen"
>
	{{ $slot }}
</button>

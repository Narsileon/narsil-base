<button
	{{ $attributes->merge(['data-slot' => 'popover-trigger', 'type' => 'button']) }}
	x-on:click="open = !open"
	x-ref="popover-trigger"
>
	{{ $slot }}
</button>

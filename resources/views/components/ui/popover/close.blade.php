<button
	{{ $attributes->merge(['data-slot' => 'popover-close', 'type' => 'button']) }}
	x-on:click="$dispatch('popover-close')"
>
	{{ $slot }}
</button>

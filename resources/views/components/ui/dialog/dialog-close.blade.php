<button
	{{ $attributes->merge(['data-slot' => 'dialog-close', 'type' => 'button']) }}
	x-on:click="$dispatch('dialog-close')"
>
	{{ $slot }}
</button>

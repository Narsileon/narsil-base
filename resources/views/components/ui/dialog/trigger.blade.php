<button
	{{ $attributes->merge(['data-slot' => 'dialog-trigger', 'type' => 'button']) }}
	x-on:click="$dispatch('dialog-open')"
>
	{{ $slot }}
</button>

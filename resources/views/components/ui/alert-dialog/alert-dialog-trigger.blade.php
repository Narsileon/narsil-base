<button
	{{ $attributes->merge([
	    'data-slot' => 'alert-dialog-trigger',
	    'type' => 'button',
	]) }}
	x-on:click="$dispatch('alert-dialog-open')"
>
	{{ $slot }}
</button>

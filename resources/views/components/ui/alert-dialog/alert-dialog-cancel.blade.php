<button
	{{ $attributes->merge([
	    'data-slot' => 'alert-dialog-cancel',
	    'type' => 'button',
	]) }}
	x-on:click="$dispatch('alert-dialog-close')"
>
	{{ $slot }}
</button>

<div
	{{ $attributes->twMerge('fixed inset-0 z-50 bg-black/50')->merge([
	    'data-slot' => 'dialog-backdrop',
	]) }}
	x-cloak
	x-on:click="$dispatch('dialog-close')"
	x-show="open"
	x-transition.opacity
></div>

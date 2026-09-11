<x-narsil::ui.backdrop.backdrop-root
	{{ $attributes->twMerge('bg-black/50')->merge([
	    'data-slot' => 'dialog-backdrop',
	]) }}
	x-cloak
	x-on:click.self="$dispatch('dialog-close')"
	x-show="dialogOpen"
	x-transition.opacity
>
	{{ $slot }}
</x-narsil::ui.backdrop.backdrop-root>

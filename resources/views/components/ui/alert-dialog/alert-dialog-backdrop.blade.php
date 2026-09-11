<x-narsil::ui.backdrop.backdrop-root
	{{ $attributes->twMerge('bg-black/50')->merge([
	    'data-slot' => 'alert-dialog-backdrop',
	]) }}
	x-cloak
	x-show="alertDialogOpen"
	x-transition.opacity
>
</x-narsil::ui.backdrop.backdrop-root>

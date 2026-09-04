
<x-narsil::ui.button.button-root
	{{ $attributes->merge([
	    'data-slot' => 'input-group-button',
	    'size' => $size,
	    'variant' => $variant,
	]) }}
>
	{{ $slot }}
</x-narsil::ui.button.button-root>

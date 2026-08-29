@props([
    'size' => 'sm',
    'variant' => 'ghost',
])

<x-narsil::ui.button.root
	{{ $attributes->merge([
	    'data-slot' => 'input-group-button',
	    'size' => $size,
	    'variant' => $variant,
	]) }}
>
	{{ $slot }}
</x-narsil::ui.button.root>

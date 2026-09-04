<x-narsil::ui.button.button-root
	{{ $attributes->merge(['data-slot' => 'alert-dialog-action']) }}
>
	{{ $slot }}
</x-narsil::ui.button.button-root>

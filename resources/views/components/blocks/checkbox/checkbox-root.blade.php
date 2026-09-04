
<x-narsil::ui.checkbox.checkbox-root
	{{ $attributes }}
>
	<x-narsil::ui.checkbox.checkbox-indicator />
	<input
		name="{{ $name }}"
		type="hidden"
		value="{{ $value }}"
		x-bind:disabled="!checked"
	>
</x-narsil::ui.checkbox.checkbox-root>

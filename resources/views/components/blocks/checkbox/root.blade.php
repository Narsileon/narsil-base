@props(['name' => null, 'required' => false, 'value' => '1'])

<x-narsil::ui.checkbox.root
	{{ $attributes }}
>
	<x-narsil::ui.checkbox.indicator />
	<input
		name="{{ $name }}"
		type="hidden"
		value="{{ $value }}"
		x-bind:disabled="!checked"
	>
</x-narsil::ui.checkbox.root>

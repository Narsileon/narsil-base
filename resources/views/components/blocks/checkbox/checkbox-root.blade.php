@php
	$click = $attributes->get('x-on:click', 'checked = !checked');
	$attributes = $attributes->except('x-on:click');
@endphp

<x-narsil::ui.checkbox.checkbox-root
	:checked="$checked"
	:disabled="$disabled"
	{{ $attributes }}
	x-on:click="{{ $click }}; $dispatch('narsil-checkbox-change', { value: checked })"
>
	<x-narsil::ui.checkbox.checkbox-indicator />
	<input
		name="{{ $name }}"
		type="hidden"
		value="{{ $value }}"
		x-bind:disabled="!checked || @js((bool) $disabled)"
	>
</x-narsil::ui.checkbox.checkbox-root>

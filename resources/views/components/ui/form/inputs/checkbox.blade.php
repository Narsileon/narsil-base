@props(['element', 'id', 'value' => false])

<x-narsil::ui.field.label
	:required="$element->required ?? false"
	for="{{ $id }}"
>
	<input
		@required($element->required ?? false)
		@checked($value)
		@disabled($element->readOnly ?? false)
		id="{{ $id }}"
		name="{{ $id }}"
		type="checkbox"
		value="1"
	>
	<span
		class="ml-2"
	>
		{{ $element->label }}
	</span>
</x-narsil::ui.field.label>

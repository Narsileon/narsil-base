@props(['element', 'id', 'value' => false])

<x-narsil::ui.switch.root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:name="$id"
	:required="$element->required ?? false"
>
	{{ $element->label }}
</x-narsil::ui.switch.root>

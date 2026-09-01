@props(['element', 'id', 'value' => false])

<x-narsil::blocks.checkbox.root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:id="$id"
	:name="$id"
	:required="$element->required ?? false"
/>

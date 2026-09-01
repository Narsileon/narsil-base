@props(['element', 'id', 'value' => false])

<x-narsil::blocks.switch.root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:name="$id"
	:required="$element->required ?? false"
/>

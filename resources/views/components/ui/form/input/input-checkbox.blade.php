
<x-narsil::blocks.checkbox.checkbox-root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:id="$id"
	:name="$id"
	:required="$element->required ?? false"
/>

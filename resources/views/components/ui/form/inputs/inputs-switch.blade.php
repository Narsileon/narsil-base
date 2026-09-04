
<x-narsil::blocks.switch.switch-root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:name="$id"
	:required="$element->required ?? false"
/>

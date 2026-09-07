<x-narsil::blocks.switch.switch-root
	:checked="$value"
	:disabled="$element->readOnly ?? false"
	:name="$name"
	:required="$element->required ?? false"
/>

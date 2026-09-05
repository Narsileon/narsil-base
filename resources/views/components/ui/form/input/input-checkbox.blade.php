@if (!empty($input->options))
	<x-narsil::blocks.checkboxes.checkboxes-root
		:disabled="$element->readOnly ?? false"
		:id="$id"
		:name="$id"
		:options="$input->options"
		:values="$value ?? []"
	/>
@else
	<x-narsil::blocks.checkbox.checkbox-root
		:checked="$value"
		:disabled="$element->readOnly ?? false"
		:id="$id"
		:name="$id"
		:required="$element->required ?? false"
	/>
@endif

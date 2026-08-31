@props(['element', 'input', 'id'])

<x-narsil::ui.input.root
	:accept="$input->accept ?? '*/*'"
	:disabled="$element->readOnly ?? false"
	:name="$id"
	:required="$element->required ?? false"
	id="{{ $id }}"
	type="file"
/>

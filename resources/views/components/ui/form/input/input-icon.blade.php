<x-narsil::blocks.combobox.combobox-root
	:id="$id"
	:name="$name"
	:options="$options"
	:placeholder="$input->placeholder ?? null"
	:render-label="true"
	:required="$element->required ?? false"
	:value="$value"
	{{ $attributes }}
/>

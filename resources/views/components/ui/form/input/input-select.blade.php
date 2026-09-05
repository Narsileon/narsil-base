<x-narsil::blocks.select.select-root
	:id="$id"
	:model="$model"
	:name="$name"
	:options="is_array($input) ? $input['options'] ?? [] : $input->options ?? []"
	:required="$element?->required ?? false"
	:trigger="$input->trigger ?? 'label'"
	:value="$value"
	{{ $attributes }}
/>

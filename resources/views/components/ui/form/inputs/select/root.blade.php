@props([
    'element' => null,
    'id',
    'input' => null,
    'model' => null,
    'value' => null,
])

<x-narsil::blocks.select.root
	:id="$id"
	:model="$model"
	:name="$id"
	:options="is_array($input) ? $input['options'] ?? [] : $input->options ?? []"
	:required="$element?->required ?? false"
	:value="$value"
	{{ $attributes }}
/>

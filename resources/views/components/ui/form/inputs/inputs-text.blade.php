
<x-narsil::ui.input-group.input-group-root>
	<x-narsil::ui.input-group.input-group-input
		:autocomplete="$input->autoComplete ?? 'off'"
		:maxlength="$input->maxLength ?? null"
		:minlength="$input->minLength ?? null"
		:name="$id"
		:placeholder="$input->placeholder ?? null"
		:readonly="$element->readOnly ?? false"
		:required="$element->required ?? false"
		:type="$type"
		:value="$value"
		id="{{ $id }}"
	/>
	@if ($element->icon ?? null)
		<x-narsil::ui.input-group.input-group-addon
			align="inline-end"
		>
			<x-narsil::ui.icon.icon-root
				:name="$element->icon"
				class="opacity-50"
			/>
		</x-narsil::ui.input-group.input-group-addon>
	@endif
</x-narsil::ui.input-group.input-group-root>

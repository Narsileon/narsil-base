
@php
	$input = $element->input;
	$id = $element->id;
	$type = $input->type;
	$value = old($id, $value ?? $input->defaultValue ?? '');
	$labelFor = $type === 'select' || $type === 'combobox' ? null : $id;
@endphp

<x-narsil::ui.form.form-field
	:element="$element"
	:orientation="$type === 'checkbox' || $type === 'switch' ? 'horizontal' : 'vertical'"
>
	@if ($type === 'switch')
		<x-narsil::ui.field.field-label
			:for="$labelFor"
			:required="$element->required ?? false"
		>
			{{ $element->label }}
		</x-narsil::ui.field.field-label>
		<x-narsil::ui.form.inputs.inputs-switch
			:element="$element"
			:id="$id"
			:value="$value"
		/>
	@elseif ($type === 'checkbox')
		<x-narsil::ui.field.field-label
			:for="$labelFor"
			:required="$element->required ?? false"
		>
			{{ $element->label }}
		</x-narsil::ui.field.field-label>
		<x-narsil::ui.form.inputs.inputs-checkbox
			:element="$element"
			:id="$id"
			:value="$value"
		/>
	@else
		<x-narsil::ui.field.field-label
			:for="$labelFor"
			:required="$element->required ?? false"
		>
			{{ $element->label }}
		</x-narsil::ui.field.field-label>
		@switch($type)
			@case('radio')
				<x-narsil::ui.radio-group.radio-group-root>
					@foreach ($input->options ?? [] as $option)
						<x-narsil::ui.radio-group.radio-group-item
							:checked="(string) $value === (string) $option->value"
							:name="$id"
							:required="$element->required ?? false"
							:value="$option->value"
						>
							{{ strip_tags($option->label) }}
						</x-narsil::ui.radio-group.radio-group-item>
					@endforeach
				</x-narsil::ui.radio-group.radio-group-root>
			@break

			@case('select')
				<x-narsil::ui.form.inputs.inputs-select
					:element="$element"
					:id="$id"
					:input="$input"
					:value="$value"
				/>
			@break

			@case('combobox')
				<x-narsil::blocks.combobox.combobox-root
					:id="$id"
					:name="$id"
					:options="$input->options ?? []"
					:placeholder="$input->placeholder ?? ''"
					:required="$element->required ?? false"
					:value="$value"
				/>
			@break

			@case('range')
				<x-narsil::ui.form.inputs.inputs-range
					:id="$id"
					:input="$input"
					:value="$value"
				/>
			@break

			@case('textarea')
				<x-narsil::ui.textarea.textarea-root
					:maxlength="$input->maxLength ?? null"
					:name="$id"
					:placeholder="$input->placeholder ?? null"
					:readonly="$element->readOnly ?? false"
					:required="$element->required ?? false"
				>
					{{ $value }}
				</x-narsil::ui.textarea.textarea-root>
			@break

			@default
				@if ($type === 'password')
					<x-narsil::ui.form.inputs.inputs-password
						:element="$element"
						:id="$id"
						:input="$input"
					/>
				@elseif ($type === 'file')
					<x-narsil::ui.form.inputs.inputs-file
						:element="$element"
						:id="$id"
						:input="$input"
					/>
				@else
					<x-narsil::ui.form.inputs.inputs-text
						:element="$element"
						:id="$id"
						:input="$input"
						:type="$type"
						:value="$value"
					/>
				@endif
		@endswitch
	@endif
</x-narsil::ui.form.form-field>

<x-narsil::ui.form.form-field
	:element="$element"
	:orientation="$orientation"
	:translatable="$translatable"
	:translation-values="$translationValues"
>
	@if ($translatable)
		@foreach ($translationValues as $language => $translationValue)
			<input
				name="{{ $id }}[{{ $language }}]"
				type="hidden"
				value="{{ $translationValue }}"
				x-bind:value="translationValues['{{ $language }}']"
			>
		@endforeach
	@endif
	<div
		class="flex items-center justify-between gap-3"
	>
		<div
			class="flex items-center gap-1"
		>
			<x-narsil::ui.field.field-label
				:for="$labelFor"
				:required="$element->required ?? false"
			>
				{{ $element->label }}
			</x-narsil::ui.field.field-label>
			@if ($translatable)
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="globe"
				/>
				<span
					class="ml-1"
				>
					-
				</span>
				<x-narsil::ui.form.form-field-language
					:id="$id . '-language'"
					:languages="$languages"
					:value="app()->getLocale()"
				/>
			@endif
		</div>
	</div>
	@if ($type === 'switch')
		<x-narsil::ui.form.input.input-switch
			:element="$element"
			:id="$id"
			:value="$value"
		/>
	@elseif ($type === 'checkbox')
		<x-narsil::ui.form.input.input-checkbox
			:element="$element"
			:id="$id"
			:input="$input"
			:value="$value"
		/>
	@else
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
				@if ($translatable)
					<x-narsil::ui.form.input.input-select
						:element="$element"
						:id="$id"
						:input="$input"
						:translatable="true"
						:value="$value"
						x-on:field-language-change.window="value = translationValues[$event.detail.value] ?? ''"
						x-on:form-language-change.window="value = translationValues[$event.detail.value] ?? ''"
						x-on:select-change="translationValues[fieldLanguage] = $event.detail.value"
					/>
				@else
					<x-narsil::ui.form.input.input-select
						:element="$element"
						:id="$id"
						:input="$input"
						:value="$value"
					/>
				@endif
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
				<x-narsil::ui.form.input.input-range
					:id="$id"
					:input="$input"
					:value="$value"
				/>
			@break

			@case('textarea')
				@if ($translatable)
					<x-narsil::ui.textarea.textarea-root
						:maxlength="$input->maxLength ?? null"
						:placeholder="$input->placeholder ?? null"
						:readonly="$element->readOnly ?? false"
						:required="$element->required ?? false"
						x-model="translationValues[fieldLanguage]"
					>
						{{ $value }}
					</x-narsil::ui.textarea.textarea-root>
				@else
					<x-narsil::ui.textarea.textarea-root
						:maxlength="$input->maxLength ?? null"
						:name="$id"
						:placeholder="$input->placeholder ?? null"
						:readonly="$element->readOnly ?? false"
						:required="$element->required ?? false"
					>
						{{ $value }}
					</x-narsil::ui.textarea.textarea-root>
				@endif
			@break

			@default
				@if ($type === 'password')
					<x-narsil::ui.form.input.input-password
						:element="$element"
						:id="$id"
						:input="$input"
					/>
				@elseif ($type === 'file')
					<x-narsil::ui.form.input.input-file
						:element="$element"
						:id="$id"
						:input="$input"
					/>
				@else
					@if ($translatable)
						<x-narsil::ui.form.input.input-text
							:element="$element"
							:id="$id"
							:input="$input"
							:translatable="true"
							:type="$type"
							:value="$value"
							x-model="translationValues[fieldLanguage]"
						/>
					@else
						<x-narsil::ui.form.input.input-text
							:element="$element"
							:id="$id"
							:input="$input"
							:type="$type"
							:value="$value"
						/>
					@endif
				@endif
		@endswitch
	@endif
</x-narsil::ui.form.form-field>

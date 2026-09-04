
@if (count($languages) > 0)
	<select
		{{ $attributes->twMerge('h-7 rounded-md border border-transparent bg-transparent px-1 text-xs uppercase outline-none focus-visible:border-primary')->merge(['data-slot' => 'form-field-language']) }}
		x-model="formLanguage"
	>
		@foreach ($languages as $language)
			<option
				value="{{ $language->value }}"
			>
				{{ $language->value }}
			</option>
		@endforeach
	</select>
@endif

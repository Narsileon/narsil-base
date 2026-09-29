<x-narsil::ui.field.field-root
	:orientation="$orientation"
	:width="$element->width ?? 100"
	{{ $attributes }}
	class="{{ $element->className ?? '' }}"
	data-livewire-field="{{ $id ?? $name }}"
	x-data="{{ $state }}"
	x-effect="if (typeof formLanguage !== 'undefined') fieldLanguage = formLanguage"
	x-on:input.debounce.250ms="syncLivewireEvent($event)"
	x-on:change.debounce.250ms="syncLivewireEvent($event)"
	x-on:combobox-change="syncLivewireEvent($event)"
	x-on:field-language-change="fieldLanguage = $event.detail.value"
	x-on:narsil-checkbox-change="syncLivewireEvent($event)"
	x-on:narsil-checkboxes-change="syncLivewireEvent($event)"
	x-on:narsil-sortable-change="syncLivewireEvent($event)"
	x-on:rich-text-change="syncLivewireEvent($event)"
>
	{{ $slot }}
	@if ($element->description ?? null)
		<x-narsil::ui.field.field-description>
			{{ $element->description }}
		</x-narsil::ui.field.field-description>
	@endif
	@error($errorKey)
		<x-narsil::ui.field.field-error>
			{{ $message }}
		</x-narsil::ui.field.field-error>
	@enderror
	@if ($translatable)
		@foreach ($translationValues as $language => $translationValue)
			@error($errorKey . '.' . $language)
				<x-narsil::ui.field.field-error>
					{{ $message }}
				</x-narsil::ui.field.field-error>
			@enderror
		@endforeach
	@endif
</x-narsil::ui.field.field-root>

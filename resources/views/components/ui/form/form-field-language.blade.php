@if (count($languages) > 0)
	<x-narsil::blocks.select.select-root
		:id="$id"
		:options="$languages"
		:value="$value"
		{{ $attributes->merge([
		    'data-slot' => 'form-language',
		]) }}
		size="sm"
		trigger-class="uppercase"
		trigger="value"
		variant="inline"
		x-on:form-language-change.window="value = $event.detail.value"
		x-on:select-change="fieldLanguage = $event.detail.value; $dispatch('field-language-change', { value: fieldLanguage })"
	>
	</x-narsil::blocks.select.select-root>
@endif

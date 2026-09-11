@php
	$fieldsetBaseId = $baseId ?? data_get($fieldset, 'id');
	$collapsible = (bool) data_get($fieldset, 'collapsible', false);
	$virtual = data_get($fieldset, 'virtual') === true;
@endphp

<x-narsil::ui.collapsible.collapsible-root
	:open="true"
	class="group col-span-full rounded border"
>
	<x-narsil::ui.collapsible.collapsible-trigger
		:disabled="!$collapsible"
		class="bg-muted text-muted-foreground flex w-full items-center justify-between px-4 py-2 text-left"
	>
		<x-narsil::ui.heading.heading-root
			level="h2"
			variant="h6"
		>
			{{ data_get($fieldset, 'label', '') }}
		</x-narsil::ui.heading.heading-root>
		@if ($collapsible)
			<x-narsil::ui.icon.icon-root
				class="duration-300 group-data-[state=open]:rotate-180"
				name="fa-regular-chevron-down"
			/>
		@endif
	</x-narsil::ui.collapsible.collapsible-trigger>
	<x-narsil::ui.collapsible.collapsible-panel
		class="grid grid-cols-12 gap-x-4 gap-y-8 p-4"
	>
		@foreach (data_get($fieldset, 'elements', []) as $fieldsetElement)
			@php
				$elementId = data_get($fieldsetElement, 'id');
				$virtualId = $virtual ? $elementId : "$fieldsetBaseId.$elementId";
				$nestedElements = data_get($fieldsetElement, 'elements');
			@endphp
			@if (is_array($nestedElements) || $nestedElements instanceof \Traversable)
				@include('narsil::components.ui.form.form-block', [
					'baseId' => $virtualId,
					'fieldset' => $fieldsetElement,
					'formData' => $formData,
					'languages' => $languages,
				])
			@else
				<x-narsil::ui.form.form-element
					:element="$fieldsetElement"
					:id="$virtualId"
					:languages="$languages"
					:value="data_get($formData, $virtualId)"
				/>
			@endif
		@endforeach
	</x-narsil::ui.collapsible.collapsible-panel>
</x-narsil::ui.collapsible.collapsible-root>

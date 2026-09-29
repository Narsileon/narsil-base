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
			{{ $fieldsetLabel }}
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
		@foreach ($elements as $fieldsetElement)
			@if ($fieldsetElement['isFieldset'])
				<x-narsil::ui.form.form-block
					:base-id="$fieldsetElement['id']"
					:fieldset="$fieldsetElement['element']"
					:form-data="$formData"
					:languages="$languages"
					:model="$model"
					:options="$options"
				/>
			@else
				<x-narsil::ui.form.form-element
					:element="$fieldsetElement['element']"
					:id="$fieldsetElement['id']"
					:languages="$languages"
					:model="$model"
					:options="$options"
					:value="$fieldsetElement['value']"
				/>
			@endif
		@endforeach
	</x-narsil::ui.collapsible.collapsible-panel>
</x-narsil::ui.collapsible.collapsible-root>

@props([
	'form',
	'showSubmit' => true,
	'values' => [],
])

<x-narsil::ui.form.root
	:action="$form->action"
	:enctype="$form->id === 'profile-form' ? 'multipart/form-data' : 'application/x-www-form-urlencoded'"
	:id="$form->id"
	:method="$form->method"
	class="grid-cols-12 gap-4"
>
	@foreach ($form->steps as $step)
		@foreach ($step->elements ?? [] as $element)
			<x-narsil::ui.form.element
				:element="$element"
				:value="$values[$element->id] ?? null"
			/>
		@endforeach
	@endforeach
	@if ($showSubmit)
		<x-narsil::ui.button.root
			class="col-span-full justify-self-end"
			type="submit"
		>
			@if ($form->submitIcon ?? null)
				<x-narsil::ui.icon.root
					:name="$form->submitIcon"
				/>
			@endif
			{{ $form->submitLabel }}
		</x-narsil::ui.button.root>
	@endif
</x-narsil::ui.form.root>

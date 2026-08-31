@props(['steps' => []])

<div
	{{ $attributes->twMerge('col-span-full')->merge(['data-slot' => 'form-tabs']) }}
	x-data="{ activeStep: @js($steps[0]->id ?? 0) }"
>
	@if (count($steps) > 1)
		<div
			class="bg-background sticky top-0 z-10 flex w-full items-center border-b px-4"
		>
			@foreach ($steps as $index => $step)
				<button
					class="border-b-2 border-transparent px-3 py-2 text-sm font-medium"
					type="button"
					x-on:click="activeStep = @js($step->id ?? $index)"
				>
					{{ $step->label ?? '' }}
				</button>
			@endforeach
		</div>
	@endif
	@foreach ($steps as $index => $step)
		<div
			class="grid w-full grid-cols-12 gap-x-4 gap-y-8"
			x-cloak
			x-show="activeStep === @js($step->id ?? $index)"
		>
			@foreach ($step->elements ?? [] as $element)
				<x-narsil::ui.form.element
					:element="$element"
				/>
			@endforeach
		</div>
	@endforeach
</div>

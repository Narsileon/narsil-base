<div
	{{ $attributes->twMerge('col-span-full flex min-h-0 flex-1 flex-col')->merge([
	    'data-slot' => 'form-tabs',
	]) }}
	x-data="{ activeStep: 0 }"
>
	<x-narsil::ui.tabs.tabs-root
		class="min-h-0 flex-1"
	>
		@if (count($steps) > 1)
			<x-narsil::ui.tabs.tabs-list
				class="bg-background h-13 shrink-0 flex w-full items-center border-b px-4 py-2"
			>
				@foreach ($steps as $index => $step)
					<x-narsil::ui.tabs.tabs-tab
						x-bind:data-active="activeStep === {{ $index }}"
						x-on:click="activeStep = {{ $index }}"
					>
						{{ $step->label ?? '' }}
					</x-narsil::ui.tabs.tabs-tab>
				@endforeach
			</x-narsil::ui.tabs.tabs-list>
		@endif
		<div
			class="min-h-0 flex-1 overflow-y-auto"
		>
			@foreach ($steps as $index => $step)
				<x-narsil::ui.tabs.tabs-panel
					class="grid w-full max-w-5xl grow-0 grid-cols-12 gap-x-4 gap-y-8 place-self-center p-4"
					x-cloak
					x-show="activeStep === {{ $index }}"
				>
					@foreach ($step->elements ?? [] as $element)
						<x-narsil::ui.form.form-element
							:element="$element"
							:languages="$languages"
							:value="data_get($formData, $element->id)"
						/>
					@endforeach
				</x-narsil::ui.tabs.tabs-panel>
			@endforeach
		</div>
	</x-narsil::ui.tabs.tabs-root>
</div>

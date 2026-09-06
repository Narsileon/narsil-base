<div
	{{ $attributes->twMerge('col-span-full flex h-full min-h-0 flex-1 flex-col')->merge([
	    'data-slot' => 'form-tabs',
	]) }}
	x-data="{ activeStep: 0 }"
>
	@php
		$tabSteps = $steps;

		if ($sidebar)
		{
			$tabSteps[] = $sidebar;
		}
	@endphp
	<x-narsil::ui.tabs.tabs-root
		class="h-full min-h-0 flex-1"
	>
		@if (count($tabSteps) > 1)
			<div
				class="flex h-13 shrink-0 border-b"
			>
				<x-narsil::ui.tabs.tabs-list
					class="bg-background h-full min-w-0 flex-1 items-center overflow-hidden px-4 py-2 max-md:overflow-x-auto max-md:overflow-y-hidden md:!overflow-x-hidden md:!overflow-y-hidden"
				>
					@foreach ($tabSteps as $index => $step)
						@php
							$tabClass = '';

							if (($step->id ?? null) === 'sidebar')
							{
								$tabClass = 'md:hidden';
							}
						@endphp
						<x-narsil::ui.tabs.tabs-tab
							class="{{ $tabClass }}"
							x-bind:data-active="activeStep === {{ $index }}"
							x-on:click="activeStep = {{ $index }}"
						>
							{{ $step->label ?? '' }}
						</x-narsil::ui.tabs.tabs-tab>
					@endforeach
				</x-narsil::ui.tabs.tabs-list>
				<div
					class="flex shrink-0 items-center border-l px-2 md:hidden"
				>
					{{ $slot }}
				</div>
			</div>
		@endif
		<div
			class="min-h-0 flex-1 overflow-x-hidden overflow-y-auto"
		>
			@foreach ($tabSteps as $index => $step)
				@php
					$panelClass = '';
					$panelPadding = 'p-4';

					if (($step->id ?? null) === 'sidebar')
					{
						$panelClass = 'md:hidden';
						$panelPadding = 'max-md:p-0';
					}
				@endphp
				<x-narsil::ui.tabs.tabs-panel
					class="grid min-w-0 w-full max-w-5xl grow-0 grid-cols-12 gap-x-4 gap-y-8 place-self-center {{ $panelPadding }} {{ $panelClass }}"
					x-cloak
					x-show="activeStep === {{ $index }}"
				>
					@if (($step->id ?? null) === 'sidebar')
						@if (data_get($formData, 'created_at') || data_get($formData, 'updated_at'))
							<div
								class="col-span-full grid items-start gap-4 border-b p-4"
							>
								<x-narsil::ui.form.form-blame
									:data="$formData"
								/>
							</div>
						@endif
						@if ($languages)
							<div
								class="col-span-full"
							>
								<x-narsil::ui.form.form-language
									:default-language="$defaultLanguage"
									:languages="$languages"
									:value="$defaultLanguage"
								/>
							</div>
						@endif
					@endif
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

<div
	{{ $attributes->twMerge('col-span-full flex h-full min-h-0 flex-1 flex-col')->merge([
	    'data-slot' => 'form-tabs',
	]) }}
	@if ($model) data-livewire-form-prefix="{{ $model }}" @endif
	x-data="{ activeStep: 0 }"
>
	<x-narsil::ui.tabs.tabs-root
		class="h-full min-h-0 flex-1"
	>
		@if (count($steps) > 1)
			<div
				class="h-13 flex shrink-0 border-b"
			>
				<x-narsil::ui.tabs.tabs-list
					class="bg-background h-full min-w-0 flex-1 items-center overflow-hidden px-4 py-2 max-md:overflow-x-auto max-md:overflow-y-hidden md:!overflow-x-hidden md:!overflow-y-hidden"
				>
					@foreach ($steps as $index => $step)
						@php
							$tabClass = '';

							if ($step['isSidebar']) {
							    $tabClass = 'md:hidden';
							}
						@endphp
						<x-narsil::ui.tabs.tabs-tab
							class="{{ $tabClass }}"
							x-bind:data-active="activeStep === {{ $index }}"
							x-on:click="activeStep = {{ $index }}"
						>
							{{ $step['label'] }}
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
			class="min-h-0 flex-1 overflow-y-auto overflow-x-hidden"
		>
			@foreach ($steps as $index => $step)
				@php
					$panelClass = '';
					$panelPadding = 'p-4';

					if ($step['isSidebar']) {
					    $panelClass = 'md:hidden';
					    $panelPadding = 'max-md:p-0';
					}
				@endphp
				<x-narsil::ui.tabs.tabs-panel
					class="{{ $panelPadding }} {{ $panelClass }} grid w-full min-w-0 max-w-5xl grow-0 grid-cols-12 gap-x-4 gap-y-8 place-self-center"
					x-cloak
					x-show="activeStep === {{ $index }}"
				>
					@if ($step['isSidebar'])
						@if ($hasBlameData)
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
					@foreach ($step['elements'] as $element)
						@if ($element['isFieldset'])
							<x-narsil::ui.form.form-block
								:base-id="$element['id']"
								:fieldset="$element['element']"
								:form-data="$formData"
								:languages="$languages"
								:model="$model"
								:options="$options"
							/>
						@else
							<x-narsil::ui.form.form-element
								:element="$element['element']"
								:languages="$languages"
								:model="$model"
								:options="$options"
								:value="$element['value']"
							/>
						@endif
					@endforeach
				</x-narsil::ui.tabs.tabs-panel>
			@endforeach
		</div>
	</x-narsil::ui.tabs.tabs-root>
</div>

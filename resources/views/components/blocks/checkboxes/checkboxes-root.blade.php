<div
	{{ $attributes->twMerge('w-full')->merge([
	    'data-slot' => 'checkboxes-root',
	]) }}
	x-data="{
    values: @js($selectedValues),
    optionValues: @js($optionValues),
    allChecked() {
        return this.optionValues.length > 0 && this.optionValues.every((value) => this.values.includes(value));
    },
    someChecked() {
        return this.values.some((value) => this.optionValues.includes(value)) && !this.allChecked();
    },
    toggleAll() {
        const allChecked = this.allChecked();

        this.values = allChecked ?
            this.values.filter((value) => !this.optionValues.includes(value)) : [...new Set([...this.values, ...this.optionValues])];
    },
    toggleValue(value) {
        this.values = this.values.includes(value) ?
            this.values.filter((selectedValue) => selectedValue !== value) : [...this.values, value];
    }
}"
>
	<x-narsil::ui.table.table-wrapper>
		<x-narsil::ui.table.table-root>
			<x-narsil::ui.table.table-body>
				<x-narsil::ui.table.table-row
					class="bg-accent border-b-2"
				>
					<x-narsil::ui.table.table-cell>
						<div
							class="flex items-center justify-start gap-2"
						>
							<x-narsil::ui.checkbox.checkbox-root
								:disabled="$disabled"
								aria-label="{{ trans('narsil::ui.all') }}"
								x-bind:data-indeterminate="someChecked() ? 'true' : null"
								x-effect="checked = allChecked()"
								x-on:click="checked = !checked; toggleAll()"
							>
								<x-narsil::ui.checkbox.checkbox-indicator
									x-show="checked && !someChecked()"
								/>
								<span
									class="grid place-content-center text-current"
									x-cloak
									x-show="someChecked()"
								>
									<x-narsil::ui.icon.icon-root
										class="size-3.5 text-current"
										name="minus"
									/>
								</span>
							</x-narsil::ui.checkbox.checkbox-root>
							<span>
								{{ trans('narsil::ui.all') }}
							</span>
						</div>
					</x-narsil::ui.table.table-cell>
				</x-narsil::ui.table.table-row>
				@foreach ($options as $option)
					@php
						$optionValue = data_get($option, 'value');
						$optionLabel = data_get($option, 'label', '');
					@endphp
					<x-narsil::ui.table.table-row>
						<x-narsil::ui.table.table-cell>
							<div
								class="flex items-center justify-start gap-2"
							>
								<x-narsil::blocks.checkbox.checkbox-root
									:checked="in_array((string) $optionValue, $selectedValues, true)"
									:disabled="$disabled"
									:id="$id . '-' . $loop->index"
									:name="$name . '[]'"
									:value="$optionValue"
									aria-label="{{ strip_tags($optionLabel) }}"
									x-effect="checked = values.includes({{ Illuminate\Support\Js::from((string) $optionValue) }})"
									x-on:click="checked = !checked; toggleValue({{ Illuminate\Support\Js::from((string) $optionValue) }})"
								/>
								<span>
									{{ strip_tags($optionLabel) }}
								</span>
							</div>
						</x-narsil::ui.table.table-cell>
					</x-narsil::ui.table.table-row>
				@endforeach
			</x-narsil::ui.table.table-body>
		</x-narsil::ui.table.table-root>
	</x-narsil::ui.table.table-wrapper>
</div>

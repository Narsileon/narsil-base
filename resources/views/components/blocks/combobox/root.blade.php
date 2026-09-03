<div
	{{ $attributes->twMerge('relative w-full')->merge(['data-slot' => 'combobox-root']) }}
	x-data="{
    open: false,
    search: '',
    value: @js($initialValue),
    dropdownId: @js($dropdownId),
    model: @js($model),
    options: @js($normalizedOptions),
    filtered() {
        const query = this.search.toLowerCase();
        return this.options.filter(option => !query || option.label.toLowerCase().includes(query));
    },
    selected(optionValue) {
        @if($multiple)
        return this.value.includes(String(optionValue));
        @else
        return String(this.value) === String(optionValue);
        @endif
    },
    select(optionValue) {
        @if($multiple)
        const next = String(optionValue);
        this.value = this.selected(next) ? this.value.filter(item => item !== next) : [...this.value, next];
        @else
        this.value = String(optionValue);
        this.open = false;
        if (this.$store.narsilDropdown) this.$store.narsilDropdown.close(this.dropdownId);
        @endif
        this.search = '';
        if (this.model) $wire.$set(this.model, this.value, true);
        this.$dispatch('combobox-change', { value: this.value });
    },
    clear() {
        this.value = @js($multiple ? [] : '');
        this.search = '';
        if (this.model) $wire.$set(this.model, this.value, true);
        this.$dispatch('combobox-change', { value: this.value });
    },
    label() {
        const option = this.options.find(item => this.selected(item.value));
        return option ? option.label : @js($placeholder ?? trans('narsil::placeholders.choose'));
    }
}"
	x-effect="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') open = $store.narsilDropdown.active === dropdownId"
	x-on:dialog-close.window="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') $store.narsilDropdown.close(dropdownId); open = false"
>
	@if ($multiple)
		<x-narsil::ui.combobox.chips>
			<template
				:key="selectedValue"
				x-for="selectedValue in value"
			>
				<x-narsil::ui.combobox.chip
					x-bind:data-value="selectedValue"
				>
					<span
						x-text="options.find(option => String(option.value) === String(selectedValue))?.label"
					></span>
					<x-narsil::ui.combobox.chip-remove />
				</x-narsil::ui.combobox.chip>
			</template>
			<x-narsil::ui.combobox.input
				:placeholder="$placeholder ?? trans('narsil::placeholders.search')"
			/>
			@if ($clearable)
				<x-narsil::ui.combobox.clear
					:disabled="$disabled"
				/>
			@endif
		</x-narsil::ui.combobox.chips>
	@else
		<x-narsil::ui.combobox.trigger
			:disabled="$disabled"
			:id="$id"
			:required="$required"
		>
			<span
				class="grow text-left"
				x-text="label()"
			>
				{{ $placeholder ?? trans('narsil::placeholders.choose') }}
			</span>
		</x-narsil::ui.combobox.trigger>
	@endif

	@if ($multiple)
		<template
			:key="'input-' + selectedValue"
			x-for="selectedValue in value"
		><input
				name="{{ $name }}[]"
				type="hidden"
				x-bind:value="selectedValue"
			></template>
	@else
		<input
			@if ($required) required @endif
			name="{{ $name }}"
			type="hidden"
			x-bind:value="value"
		>
	@endif

	<x-narsil::ui.combobox.portal>
		<x-narsil::ui.combobox.positioner>
			<x-narsil::ui.combobox.popup>
				@if (!$multiple)
					<x-narsil::ui.combobox.popup-input
						:clearable="$clearable"
						:disabled="$disabled"
					/>
				@endif
				<x-narsil::ui.combobox.empty>
					{{ trans('narsil::pagination.pages_empty') }}
				</x-narsil::ui.combobox.empty>
				<x-narsil::ui.combobox.list>
					@foreach ($normalizedOptions as $option)
						<x-narsil::ui.combobox.list-item
							:display-value="$displayValue"
							:icon="$option['icon']"
							:label="$option['label']"
							:value="$option['value']"
						/>
					@endforeach
				</x-narsil::ui.combobox.list>
			</x-narsil::ui.combobox.popup>
		</x-narsil::ui.combobox.positioner>
	</x-narsil::ui.combobox.portal>
</div>

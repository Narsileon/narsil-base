<div
	{{ $attributes->twMerge('relative w-full')->merge([
	    'data-slot' => 'combobox-root',
	]) }}
	@if ($reload) data-form-reload-id="{{ $id }}" @endif
	x-data="{
    comboboxOpen: false,
    search: '',
    value: @js($initialValue),
    dropdownId: @js($dropdownId),
    fetchUrl: @js($fetchUrl),
    loading: false,
    minSearchLength: @js($minSearchLength),
    model: @js($model),
    options: @js($normalizedOptions),
    reload: @js($reload),
    displayValue: @js($displayValue),
    renderLabel: @js($renderLabel),
    virtualized: @js($virtualized),
    virtualItemHeight: 36,
    virtualStart: 0,
    virtualEnd: 0,
    filtered() {
        const query = this.search.toLowerCase();

        if (this.fetchUrl && query.length < this.minSearchLength) {
            return [];
        }

        return this.options.filter(option => !query || option.searchLabel.toLowerCase().includes(query));
    },
    normalizeOption(option) {
        let label = option.label ?? option.value ?? '';
        let searchLabel = option.searchLabel ?? label;

        if (label && typeof label === 'object') {
            label = label[@js(app()->getLocale())] ?? Object.values(label)[0] ?? option.value ?? '';
        }

        if (searchLabel && typeof searchLabel === 'object') {
            searchLabel = searchLabel[@js(app()->getLocale())] ?? Object.values(searchLabel)[0] ?? option.value ?? '';
        }

        return {
            label: String(label),
            searchLabel: String(searchLabel),
            value: String(option.value ?? ''),
        };
    },
    async fetchOptions() {
        if (!this.fetchUrl || this.search.length < this.minSearchLength) {
            return;
        }

        this.loading = true;

        try {
            const url = new URL(this.fetchUrl, window.location.origin);
            url.searchParams.set('search', this.search);
            const response = await fetch(url.toString(), { headers: { Accept: 'application/json' } });
            const fetchedOptions = await response.json();
            const mergedOptions = [...this.options, ...(Array.isArray(fetchedOptions) ? fetchedOptions : [])]
                .map(option => this.normalizeOption(option));
            const seenValues = new Set();

            this.options = mergedOptions.filter(option => {
                if (seenValues.has(option.value)) {
                    return false;
                }

                seenValues.add(option.value);

                return true;
            });
        } finally {
            this.loading = false;
        }
    },
    updateVirtualWindow() {
        const list = this.$refs['combobox-list'];
        if (!list) {
            return;
        }
        const items = this.filtered();
        const start = Math.max(0, Math.floor(list.scrollTop / this.virtualItemHeight) - 5);
        const end = Math.min(items.length, Math.ceil((list.scrollTop + list.clientHeight) / this.virtualItemHeight) + 5);
        this.virtualStart = start;
        this.virtualEnd = end;
    },
    virtualOptions() {
        return this.filtered().slice(this.virtualStart, this.virtualEnd);
    },
    scrollToSelected() {
        const list = this.$refs['combobox-list'];

        if (!list) {
            return;
        }

        if (!this.virtualized) {
            list.querySelector('[aria-selected=true]')?.scrollIntoView({ block: 'nearest' });

            return;
        }

        const selectedIndex = this.filtered().findIndex(option => this.selected(option.value));

        if (selectedIndex < 0) {
            return;
        }

        const selectedTop = selectedIndex * this.virtualItemHeight;
        const selectedBottom = selectedTop + this.virtualItemHeight;

        if (selectedTop < list.scrollTop) {
            list.scrollTop = selectedTop;
        } else if (selectedBottom > list.scrollTop + list.clientHeight) {
            list.scrollTop = selectedBottom - list.clientHeight;
        }
    },
    refreshList() {
        this.$nextTick(() => {
            requestAnimationFrame(() => {
                this.scrollToSelected();

                if (this.virtualized) {
                    this.updateVirtualWindow();
                }
            });
        });
    },
    selected(optionValue) {
        @if($multiple)
        return this.value.includes(String(optionValue));
        @else
        return String(this.value) === String(optionValue);
        @endif
    },
    selectedOption() {
        return this.options.find(option => this.selected(option.value));
    },
    select(optionValue) {
        @if($multiple)
        const next = String(optionValue);
        this.value = this.selected(next) ? this.value.filter(item => item !== next) : [...this.value, next];
        @else
        this.value = String(optionValue);
        this.comboboxOpen = false;
        if (this.$store.narsilDropdown) this.$store.narsilDropdown.close(this.dropdownId);
        @endif
        this.search = '';
        if (this.model) $wire.$set(this.model, this.value, true);
        this.$dispatch('combobox-change', { value: this.value });
        if (this.reload) this.$dispatch('form-reload', { form: this.$root.closest('form'), id: @js($id), value: this.value });
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
	x-effect="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') comboboxOpen = $store.narsilDropdown.active === dropdownId; if (comboboxOpen) refreshList()"
	x-on:dialog-close.window="if ($store.narsilDropdown && typeof dropdownId !== 'undefined') $store.narsilDropdown.close(dropdownId); comboboxOpen = false"
>
	@if ($multiple)
		<x-narsil::ui.combobox.combobox-chips>
			<template
				:key="selectedValue"
				x-for="selectedValue in value"
			>
				<x-narsil::ui.combobox.combobox-chip
					x-bind:data-value="selectedValue"
				>
					@if ($renderLabel)
						<span
							x-html="options.find(option => String(option.value) === String(selectedValue))?.label"
						></span>
					@else
						<span
							x-text="options.find(option => String(option.value) === String(selectedValue))?.label"
						></span>
					@endif
					<x-narsil::ui.combobox.combobox-chip-remove />
				</x-narsil::ui.combobox.combobox-chip>
			</template>
			<x-narsil::ui.combobox.combobox-input
				:placeholder="$placeholder ?? trans('narsil::placeholders.search')"
			/>
			@if ($clearable)
				<x-narsil::ui.combobox.combobox-clear
					:disabled="$disabled"
				/>
			@endif
		</x-narsil::ui.combobox.combobox-chips>
	@else
		<x-narsil::ui.combobox.combobox-trigger
			:disabled="$disabled"
			:id="$id"
			:required="$required"
			x-bind:aria-label="renderLabel ? (selectedOption()?.searchLabel ?? label()) : null"
		>
			@if ($renderLabel)
				<span
					class="grow text-left"
					x-html="label()"
				>
					{{ $placeholder ?? trans('narsil::placeholders.choose') }}
				</span>
			@else
				<span
					class="grow text-left"
					x-text="label()"
				>
					{{ $placeholder ?? trans('narsil::placeholders.choose') }}
				</span>
			@endif
		</x-narsil::ui.combobox.combobox-trigger>
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

	<x-narsil::ui.combobox.combobox-portal>
		<x-narsil::ui.combobox.combobox-positioner>
			<x-narsil::ui.combobox.combobox-popup>
				@if (!$multiple)
					<x-narsil::ui.combobox.combobox-popup-input
						:clearable="$clearable"
						:disabled="$disabled"
					/>
				@endif
				@if ($fetchUrl)
					<div
						class="text-muted-foreground p-2 text-center text-sm"
						x-show="loading"
					>
						...
					</div>
				@endif
				<x-narsil::ui.combobox.combobox-empty
					x-bind:class="loading ? 'hidden' : ''"
				>
					{{ trans('narsil::pagination.empty') }}
				</x-narsil::ui.combobox.combobox-empty>
				<x-narsil::ui.combobox.combobox-list>
					@if ($fetchUrl)
						<template
							:key="option.value"
							x-for="option in filtered()"
						>
							<button
								:aria-selected="selected(option.value)"
								:type="'button'"
								class="outline-hidden hover:bg-accent hover:text-accent-foreground relative flex h-9 w-full cursor-pointer select-none items-center justify-between gap-2 rounded-md py-1 pl-1.5 pr-8 text-left text-sm"
								data-slot="combobox-item"
								x-on:click="select(option.value)"
							>
								@if ($renderLabel)
									<span
										class="whitespace-nowrap"
										x-html="option.label"
									></span>
								@else
									<span
										class="grow whitespace-nowrap"
										x-text="option.label"
									></span>
								@endif
								<span
									:title="option.value"
									class="text-muted-foreground min-w-0 truncate whitespace-nowrap"
									x-show="displayValue"
									x-text="option.value"
								></span>
								<span
									class="pointer-events-none absolute right-2 flex size-4 items-center justify-center"
									x-show="selected(option.value)"
								>
									<x-narsil::ui.icon.icon-root
										class="size-4"
										name="fa-regular-check"
									/>
								</span>
							</button>
						</template>
					@elseif ($virtualized)
						<div
							:style="{ height: (filtered().length * virtualItemHeight) + 'px' }"
							class="relative"
							x-init="refreshList()"
						>
							<template
								:key="option.value"
								x-for="(option, index) in virtualOptions()"
							>
								<button
									:aria-posinset="virtualStart + index + 1"
									:aria-selected="selected(option.value)"
									:aria-setsize="filtered().length"
									:style="{ top: ((virtualStart + index) * virtualItemHeight) + 'px' }"
									:type="'button'"
									class="outline-hidden hover:bg-accent hover:text-accent-foreground absolute left-0 right-0 flex h-9 w-full cursor-pointer select-none items-center justify-between gap-2 rounded-md py-1 pl-1.5 pr-8 text-left text-sm"
									data-slot="combobox-item"
									x-on:click="select(option.value)"
								>
									@if ($renderLabel)
										<span
											class="whitespace-nowrap"
											x-html="option.label"
										></span>
									@else
										<span
											class="grow whitespace-nowrap"
											x-text="option.label"
										></span>
									@endif
									<span
										:title="option.value"
										class="text-muted-foreground min-w-0 truncate whitespace-nowrap"
										x-show="displayValue"
										x-text="option.value"
									></span>
									<span
										class="pointer-events-none absolute right-2 flex size-4 items-center justify-center"
										x-show="selected(option.value)"
									>
										<x-narsil::ui.icon.icon-root
											class="size-4"
											name="fa-regular-check"
										/>
									</span>
								</button>
							</template>
						</div>
					@else
						@foreach ($normalizedOptions as $option)
							<x-narsil::ui.combobox.combobox-list-item
								:display-value="$displayValue"
								:label="$option['label']"
								:render-label="$renderLabel"
								:value="$option['value']"
							/>
						@endforeach
					@endif
				</x-narsil::ui.combobox.combobox-list>
			</x-narsil::ui.combobox.combobox-popup>
		</x-narsil::ui.combobox.combobox-positioner>
	</x-narsil::ui.combobox.combobox-portal>
</div>

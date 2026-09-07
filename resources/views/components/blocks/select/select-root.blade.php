@php
	$state = sprintf(
	    '{ selectOpen: false, value: %s, model: %s, id: %s, dropdownId: %s, trigger: %s, options: %s, virtualized: %s, virtualItemHeight: 36, virtualStart: 0, virtualEnd: 0, updateVirtualWindow() { const list = this.$refs["select-list"]; if (!list) return; const start = Math.max(0, Math.floor(list.scrollTop / this.virtualItemHeight) - 5); const end = Math.min(this.options.length, Math.ceil((list.scrollTop + list.clientHeight) / this.virtualItemHeight) + 5); this.virtualStart = start; this.virtualEnd = end; }, virtualOptions() { return this.options.slice(this.virtualStart, this.virtualEnd); }, updateScroll() { const list = this.$refs["select-list"]; const selectedIndex = this.options.findIndex(item => String(item.value) === String(this.value)); if (!list || selectedIndex < 0 || !list.clientHeight) { this.updateVirtualWindow(); return; } const selectedTop = selectedIndex * this.virtualItemHeight; const selectedBottom = selectedTop + this.virtualItemHeight; if (selectedTop < list.scrollTop) list.scrollTop = selectedTop; else if (selectedBottom > list.scrollTop + list.clientHeight) list.scrollTop = selectedBottom - list.clientHeight; this.updateVirtualWindow(); }, label() { const option = this.options.find(item => String(item.value) === String(this.value)); return this.trigger === "value" ? this.value : (option ? option.label : %s); }, select(nextValue) { this.value = String(nextValue); this.selectOpen = false; if (this.$store.narsilDropdown) this.$store.narsilDropdown.close(this.dropdownId); this.$dispatch("select-change", { id: this.id, value: this.value }); if (this.$refs["select-input"]) { this.$refs["select-input"].value = this.value; this.$refs["select-input"].dispatchEvent(new Event("input", { bubbles: true })); } } }',
	    json_encode((string) $value),
	    json_encode($model),
	    json_encode($id),
	    json_encode($dropdownId),
	    json_encode($trigger),
	    json_encode($normalizedOptions),
	    json_encode($virtualized),
	    json_encode($placeholder ?? trans('narsil::placeholders.choose')),
	);
@endphp

<x-narsil::ui.select.select-root
	:x-data="$state"
	{{ $attributes }}
	x-on:keydown.escape.window="if ($store.narsilDropdown) $store.narsilDropdown.close(dropdownId); selectOpen = false"
>
	<x-narsil::ui.select.select-trigger
		:id="$id"
		:required="$required"
		:size="$size"
		:variant="$variant"
		class="{{ $triggerClass }}"
	>
		<x-narsil::ui.select.select-value><span
				x-html="label()"
			>{!! $selected['label'] ?? ($placeholder ?? trans('narsil::placeholders.choose')) !!}</span></x-narsil::ui.select.select-value>
		<x-narsil::ui.select.select-icon />
	</x-narsil::ui.select.select-trigger>
	<input
		@if ($required) required @endif
		@if ($name) name="{{ $name }}" @endif
		@if ($model) wire:model.live="{{ $model }}" @endif
		type="hidden"
		value="{{ $value }}"
		x-bind:value="value"
		x-ref="select-input"
	>
	<x-narsil::ui.select.select-portal>
		<x-narsil::ui.select.select-positioner>
			<x-narsil::ui.select.select-popup>
		<x-narsil::ui.select.select-list>
			@if ($virtualized)
				<div
					class="relative w-full"
					x-init="updateVirtualWindow()"
					:style="{ height: (options.length * virtualItemHeight) + 'px' }"
				>
					<template
						x-for="(option, index) in virtualOptions()"
						:key="option.value"
					>
						<button
							class="absolute right-0 left-0 flex h-9 w-full cursor-pointer items-center gap-1.5 rounded-md py-1 pr-8 pl-1.5 text-left text-sm outline-hidden select-none hover:bg-accent hover:text-accent-foreground"
							data-slot="select-item"
							:aria-posinset="virtualStart + index + 1"
							:aria-selected="String(value) === String(option.value)"
							:aria-setsize="options.length"
							:type="'button'"
							:style="{ top: ((virtualStart + index) * virtualItemHeight) + 'px' }"
							x-on:click="select(option.value)"
						>
							<span class="flex flex-1 shrink-0 gap-2 whitespace-nowrap" data-slot="select-item-text" x-html="option.label"></span>
							<span
								class="pointer-events-none absolute right-2 flex size-4 items-center justify-center"
								x-show="String(value) === String(option.value)"
							>
								<x-narsil::ui.icon.icon-root class="size-4" name="check" />
							</span>
						</button>
					</template>
				</div>
			@else
				@foreach ($normalizedOptions as $option)
					<x-narsil::ui.select.select-item
						:label="$option['label']"
						:value="$option['value']"
					/>
				@endforeach
			@endif
		</x-narsil::ui.select.select-list>
			</x-narsil::ui.select.select-popup>
		</x-narsil::ui.select.select-positioner>
	</x-narsil::ui.select.select-portal>
</x-narsil::ui.select.select-root>

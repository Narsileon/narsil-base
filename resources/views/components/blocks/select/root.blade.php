@php
	$state = sprintf(
	    '{ open: false, value: %s, model: %s, id: %s, dropdownId: %s, init() { const stored = JSON.parse(localStorage.getItem(`narsil:${this.id}`) || "null"); const storedValue = stored && stored.state ? stored.state[this.id] : undefined; if (storedValue !== undefined) { this.value = String(storedValue); if (this.model) $wire.$set(this.model, this.value); } }, updateScroll() { const list = this.$refs["select-list"]; const selected = list ? list.querySelector(`[aria-selected="true"]`) : null; if (selected && selected.scrollIntoView) selected.scrollIntoView({ block: "nearest" }); }, label() { const option = %s.find(item => String(item.value) === String(this.value)); return option ? option.label : %s; }, select(nextValue) { this.value = String(nextValue); this.open = false; if (this.$store.narsilDropdown) this.$store.narsilDropdown.close(this.dropdownId); this.$dispatch("select-change", { id: this.id, value: this.value }); if (this.$refs["select-input"]) { this.$refs["select-input"].value = this.value; this.$refs["select-input"].dispatchEvent(new Event("input", { bubbles: true })); } } }',
	    json_encode((string) $value),
	    json_encode($model),
	    json_encode($id),
	    json_encode($dropdownId),
	    json_encode($normalizedOptions),
	    json_encode($placeholder ?? trans('narsil::ui.select')),
	);
@endphp

<x-narsil::ui.select.root
	:x-data="$state"
	{{ $attributes }}
	x-on:keydown.escape.window="if ($store.narsilDropdown) $store.narsilDropdown.close(dropdownId); open = false"
>
	<x-narsil::ui.select.trigger
		:id="$id"
		:required="$required"
		:size="$size"
		:variant="$variant"
	>
		<x-narsil::ui.select.value><span
				x-html="label()"
			>{!! $selected['label'] ?? ($placeholder ?? trans('narsil::ui.select')) !!}</span></x-narsil::ui.select.value>
		<x-narsil::ui.select.icon />
	</x-narsil::ui.select.trigger>
	<input
		@if ($required) required @endif
		@if ($model) wire:model.live="{{ $model }}" @endif
		name="{{ $name }}"
		type="hidden"
		value="{{ $value }}"
		x-bind:value="value"
		x-ref="select-input"
	>
	<x-narsil::ui.select.portal>
		<x-narsil::ui.select.positioner>
			<x-narsil::ui.select.popup>
				<x-narsil::ui.select.list>
					@foreach ($normalizedOptions as $option)
						<x-narsil::ui.select.item
							:label="$option['label']"
							:value="$option['value']"
						/>
					@endforeach
				</x-narsil::ui.select.list>
			</x-narsil::ui.select.popup>
		</x-narsil::ui.select.positioner>
	</x-narsil::ui.select.portal>
</x-narsil::ui.select.root>

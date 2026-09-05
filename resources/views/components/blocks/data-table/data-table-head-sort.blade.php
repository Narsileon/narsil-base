<x-narsil::blocks.tooltip.tooltip-root
	:tooltip="$tooltip"
>
	<x-narsil::ui.button.button-root
		aria-label="{{ $tooltip }}"
		size="icon-sm"
		variant="ghost-secondary"
		x-on:click="sort({{ json_encode((string) $column['id']) }})"
	>
		<x-narsil::ui.icon.icon-root
			:name="$icon"
			class="size-3!"
		/>
	</x-narsil::ui.button.button-root>
</x-narsil::blocks.tooltip.tooltip-root>

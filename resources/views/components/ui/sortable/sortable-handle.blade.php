<x-narsil::blocks.tooltip.tooltip-root
	:tooltip="$attributes->get('aria-label', trans('narsil::ui.move'))"
>
	<x-narsil::ui.button.button-root
		{{ $attributes->twMerge('h-9 w-7 rounded-none bg-accent/85 cursor-grab active:cursor-grabbing') }}
		size="icon"
		variant="ghost"
		x-sort:handle
	>
		<x-narsil::ui.icon.icon-root
			name="fa-solid-grip-vertical"
		/>
	</x-narsil::ui.button.button-root>
</x-narsil::blocks.tooltip.tooltip-root>

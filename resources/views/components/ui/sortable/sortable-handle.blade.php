<x-narsil::blocks.tooltip.tooltip-root
	:tooltip="$attributes->get('aria-label', trans('narsil::ui.move'))"
>
	<x-narsil::ui.button.button-root
		{{ $attributes->twMerge('h-9 w-7 rounded-none bg-accent/85 cursor-grab active:cursor-grabbing') }}
		data-slot="sortable-handle"
		size="icon"
		variant="ghost"
		x-sort:handle
	>
		@if ($slot->isNotEmpty())
			{{ $slot }}
		@else
			<x-narsil::ui.icon.icon-root
				name="fa-solid-grip-vertical"
			/>
		@endif
	</x-narsil::ui.button.button-root>
</x-narsil::blocks.tooltip.tooltip-root>

<x-narsil::blocks.tooltip.tooltip-root
	:tooltip="trans('narsil::ui.close')"
>
	<x-narsil::ui.popover.popover-close
		{{ $attributes->twMerge(
		        'group/button inline-flex shrink-0 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent bg-clip-padding font-medium whitespace-nowrap ring-1 ring-transparent transition-all duration-300 outline-none select-none ' .
		            ($variant === 'ghost'
		                ? 'focus-visible:border-primary focus-visible:ring-primary hover:bg-accent hover:text-accent-foreground'
		                : 'bg-secondary/80 text-secondary-foreground focus-visible:border-primary focus-visible:ring-primary hover:bg-secondary') .
		            ' ' .
		            ($size === 'icon' ? 'size-9 rounded-full' : 'size-7 rounded-full p-1'),
		    )->merge([
		        'data-size' => $size,
		        'data-slot' => 'popover-close-button',
		    ]) }}
		aria-label="{{ trans('narsil::ui.close') }}"
	>
		<x-narsil::ui.icon.icon-root
			class="!size-4"
			name="xmark"
		/>
	</x-narsil::ui.popover.popover-close>
</x-narsil::blocks.tooltip.tooltip-root>

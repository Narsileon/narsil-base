<div
	class="relative shrink-0"
	x-data="{ preview: @js($width) }"
	x-on:mouseleave="preview = @js($width)"
>
	<div
		class="flex h-6 divide-x overflow-hidden rounded-md border"
	>
		@foreach ([25, 33, 50, 67, 75, 100] as $option)
			<x-narsil::ui.button.button-root
				aria-label="{{ $option }}%"
				class="h-full w-2.5 rounded-none border-none p-0"
				variant="outline"
				wire:click="setWidth('{{ $list['path'] }}', '{{ $row['uuid'] }}', {{ $option }})"
				x-bind:class="preview >= {{ $option }} && 'bg-accent text-accent-foreground'"
				x-on:mouseenter="preview = {{ $option }}"
			/>
		@endforeach
	</div>
	<span
		class="pointer-events-none absolute inset-0 flex items-center justify-center text-xs"
		x-text="`${preview}%`"
	></span>
</div>

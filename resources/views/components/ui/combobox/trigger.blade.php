@props(['disabled' => false, 'id' => null, 'required' => false])

<button
	{{ $attributes->twMerge('flex h-9 w-full cursor-pointer items-center justify-between gap-2 rounded-md border border-border bg-accent/50 px-3 text-sm font-normal outline-none transition-colors hover:bg-accent focus-visible:border-primary focus-visible:ring-primary disabled:pointer-events-none disabled:opacity-50')->merge(['data-slot' => 'combobox-trigger', 'id' => $id, 'type' => 'button']) }}
	@if ($required) aria-required="true" @endif
	@disabled($disabled)
	x-on:click="open = !open"
	x-ref="combobox-trigger"
>
	{{ $slot }}
	<x-narsil::ui.icon.root
		class="text-muted-foreground pointer-events-none size-4"
		name="chevron-down"
	/>
</button>

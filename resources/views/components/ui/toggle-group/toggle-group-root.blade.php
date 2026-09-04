
<div
	{{ $attributes->twMerge('group/toggle-group flex w-full items-center justify-center rounded-lg gap-[--spacing(var(--gap))] data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-stretch data-[size=sm]:rounded-[min(var(--radius-md),10px)] data-[spacing=0]:gap-0 [&>[data-slot=toggle-group-item]]:rounded-none [&>[data-slot=toggle-group-item]~[data-slot=toggle-group-item]]:border-l-0 data-[orientation=vertical]:[&>[data-slot=toggle-group-item]~[data-slot=toggle-group-item]]:border-l data-[orientation=vertical]:[&>[data-slot=toggle-group-item]~[data-slot=toggle-group-item]]:border-t-0 [&>[data-slot=toggle-group-item]:first-child]:rounded-l-md [&>[data-slot=toggle-group-item]:last-child]:rounded-r-md data-[orientation=vertical]:[&>[data-slot=toggle-group-item]:first-child]:rounded-t-md data-[orientation=vertical]:[&>[data-slot=toggle-group-item]:first-child]:rounded-l-none data-[orientation=vertical]:[&>[data-slot=toggle-group-item]:last-child]:rounded-b-md data-[orientation=vertical]:[&>[data-slot=toggle-group-item]:last-child]:rounded-r-none')->merge(['data-orientation' => $orientation, 'data-size' => $size, 'data-slot' => 'toggle-group-root', 'data-spacing' => $spacing, 'data-variant' => $variant, 'style' => "--gap: {$spacing}"]) }}
	x-data="{ selected: @js($selected) }"
	x-on:toggle-group-select.window="selected = $event.detail.value"
>
	{{ $slot }}
</div>

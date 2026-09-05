<div
	{{ $attributes->twMerge(
	        'group/toggle-group flex w-full items-center justify-center rounded-lg gap-[--spacing(var(--gap))] data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-stretch data-[size=sm]:rounded-[min(var(--radius-md),10px)]',
	    )->merge([
	        'data-orientation' => $orientation,
	        'data-size' => $size,
	        'data-slot' => 'toggle-group-root',
	        'data-spacing' => $spacing,
	        'data-variant' => $variant,
	        'style' => "--gap: {$spacing}",
	    ]) }}
	x-data="{ selected: @js($selected) }"
	x-on:toggle-group-select.window="selected = $event.detail.value"
>
	{{ $slot }}
</div>

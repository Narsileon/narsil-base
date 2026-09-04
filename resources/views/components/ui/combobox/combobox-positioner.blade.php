<div
	{{ $attributes->twMerge('isolate z-50')->merge(['data-slot' => 'combobox-positioner']) }}
	x-anchor.bottom-start="$refs['combobox-trigger']"
>
	{{ $slot }}
</div>

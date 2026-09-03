<div
	{{ $attributes->twMerge('isolate z-[60]')->merge(['data-slot' => 'select-positioner']) }}
	x-anchor.bottom-start="$refs['select-trigger']"
>
	{{ $slot }}
</div>

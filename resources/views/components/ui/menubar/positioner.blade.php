@props(['align' => 'start', 'alignOffset' => -4, 'side' => 'bottom', 'sideOffset' => 8])

<div
	{{ $attributes->twMerge('isolate z-50 outline-none')->merge(['data-align' => $align, 'data-align-offset' => $alignOffset, 'data-side' => $side, 'data-side-offset' => $sideOffset, 'data-slot' => 'menubar-positioner']) }}
>
	{{ $slot }}
</div>

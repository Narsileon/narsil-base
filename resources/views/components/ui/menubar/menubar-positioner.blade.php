<div
	{{ $attributes->twMerge('isolate z-50 outline-none')->merge(['data-align' => $align, 'data-align-offset' => $alignOffset, 'data-side' => $side, 'data-side-offset' => $sideOffset, 'data-slot' => 'menubar-positioner']) }}
>
	{{ $slot }}
</div>

<div
	{{ $attributes->twMerge('isolate z-50')->merge(['data-slot' => 'popover-positioner']) }}
	@if ($side === 'top' && $align === 'start') x-anchor.top-start="$refs['popover-trigger']"
    @elseif ($side === 'top' && $align === 'end') x-anchor.top-end="$refs['popover-trigger']"
    @elseif ($side === 'top') x-anchor.top="$refs['popover-trigger']"
    @elseif ($side === 'left' && $align === 'start') x-anchor.left-start="$refs['popover-trigger']"
    @elseif ($side === 'left' && $align === 'end') x-anchor.left-end="$refs['popover-trigger']"
    @elseif ($side === 'left') x-anchor.left="$refs['popover-trigger']"
    @elseif ($side === 'right' && $align === 'start') x-anchor.right-start="$refs['popover-trigger']"
    @elseif ($side === 'right' && $align === 'end') x-anchor.right-end="$refs['popover-trigger']"
    @elseif ($side === 'right') x-anchor.right="$refs['popover-trigger']"
    @elseif ($align === 'start') x-anchor.bottom-start="$refs['popover-trigger']"
    @elseif ($align === 'end') x-anchor.bottom-end="$refs['popover-trigger']"
    @else x-anchor.bottom="$refs['popover-trigger']" @endif
>
	{{ $slot }}
</div>

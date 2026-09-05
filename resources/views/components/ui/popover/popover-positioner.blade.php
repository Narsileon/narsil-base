<div
	{{ $attributes->twMerge('isolate z-50 w-fit')->merge(['data-slot' => 'popover-positioner']) }}
	@if ($side === 'top' && $align === 'start') x-anchor.top-start.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'top' && $align === 'end') x-anchor.top-end.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'top') x-anchor.top.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left' && $align === 'start') x-anchor.left-start.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left' && $align === 'end') x-anchor.left-end.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left') x-anchor.left.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right' && $align === 'start') x-anchor.right-start.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right' && $align === 'end') x-anchor.right-end.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right') x-anchor.right.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($align === 'start') x-anchor.bottom-start.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($align === 'end') x-anchor.bottom-end.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')"
    @else x-anchor.bottom.offset.{{ $sideOffset }}.fixed="$root.querySelector('[data-slot=popover-trigger]')" @endif
>
	{{ $slot }}
</div>

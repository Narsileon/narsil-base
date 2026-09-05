<div
	{{ $attributes->twMerge('isolate z-50')->merge(['data-slot' => 'popover-positioner']) }}
	@if ($side === 'top' && $align === 'start') x-anchor.top-start="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'top' && $align === 'end') x-anchor.top-end="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'top') x-anchor.top="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left' && $align === 'start') x-anchor.left-start="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left' && $align === 'end') x-anchor.left-end="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'left') x-anchor.left="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right' && $align === 'start') x-anchor.right-start="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right' && $align === 'end') x-anchor.right-end="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($side === 'right') x-anchor.right="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($align === 'start') x-anchor.bottom-start="$root.querySelector('[data-slot=popover-trigger]')"
    @elseif ($align === 'end') x-anchor.bottom-end="$root.querySelector('[data-slot=popover-trigger]')"
    @else x-anchor.bottom="$root.querySelector('[data-slot=popover-trigger]')" @endif
>
	{{ $slot }}
</div>

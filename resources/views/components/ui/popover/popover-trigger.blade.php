@if ($asChild)
	<span
		{{ $attributes->twMerge('inline-flex')->merge([
		    'data-slot' => 'popover-trigger',
		]) }}
		x-on:click="popoverOpen = !popoverOpen"
		x-ref="popover-trigger"
	>
		{{ $slot }}
	</span>
@else
	<button
		{{ $attributes->merge([
		    'data-slot' => 'popover-trigger',
		    'type' => 'button',
		]) }}
		x-on:click="popoverOpen = !popoverOpen"
		x-ref="popover-trigger"
	>
		{{ $slot }}
	</button>
@endif

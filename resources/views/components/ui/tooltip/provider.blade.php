@props(['delay' => 0])

<div
	{{ $attributes->twMerge() }}
	data-delay="{{ $delay }}"
	data-slot="tooltip-provider"
>
	{{ $slot }}
</div>

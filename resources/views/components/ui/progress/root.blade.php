@props(['max' => 100, 'value' => 0])

<div
	{{ $attributes->twMerge('flex flex-wrap gap-3') }}
	data-max="{{ $max }}"
	data-slot="progress-root"
	data-value="{{ $value }}"
	role="progressbar"
	x-data="{ value: @js($value), max: @js($max) }"
	x-bind:aria-valuemax="max"
	x-bind:aria-valuenow="value"
	x-bind:style="`--progress-value: ${max ? (value / max) * 100 : 0}%`"
>
	{{ $slot }}
</div>

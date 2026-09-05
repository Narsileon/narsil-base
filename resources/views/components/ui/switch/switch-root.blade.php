<label
	{{ $attributes->twMerge('inline-flex cursor-pointer items-center gap-2')->merge(['data-slot' => 'switch-root']) }}
	x-data="{ checked: @js($checked) }"
>
	<input
		@required($required)
		@checked($checked)
		@disabled($disabled)
		class="peer sr-only"
		name="{{ $name }}"
		type="checkbox"
		value="{{ $value }}"
		x-model="checked"
	>
	{{ $slot }}
</label>

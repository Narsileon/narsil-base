@props(['checked' => false, 'disabled' => false, 'name', 'required' => false, 'value' => '1'])

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
	<span
		class="h-4.5 w-8.5 bg-border peer-checked:bg-constructive peer-focus-visible:border-primary peer-focus-visible:ring-primary after:bg-background relative inline-flex shrink-0 rounded-full border border-transparent ring-1 ring-transparent transition-all after:block after:size-4 after:rounded-full after:transition-transform peer-checked:after:translate-x-full peer-disabled:cursor-not-allowed peer-disabled:opacity-50"
	></span>
	{{ $slot }}
</label>

<label
	{{ $attributes->twMerge('flex items-center gap-2')->merge([
	    'data-slot' => 'radio-group-item',
	]) }}
>
	<input
		@required($required)
		@checked($checked)
		@disabled($disabled)
		class="accent-primary size-4"
		name="{{ $name }}"
		type="radio"
		value="{{ $value }}"
	>
	{{ $slot }}
</label>

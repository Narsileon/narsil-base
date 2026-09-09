<button
	{{ $attributes->twMerge(
	        'relative flex w-full cursor-pointer items-center justify-between gap-2 rounded-md py-1 pr-8 pl-1.5 text-left text-sm outline-none hover:bg-accent hover:text-accent-foreground',
	    )->merge([
	        'data-slot' => 'combobox-item',
	        'role' => 'option',
	        'type' => 'button',
	    ]) }}
	title="{{ strip_tags($label) }}"
	x-bind:aria-selected="selected(@js($value))"
	x-on:click="select(@js($value))"
	x-show="filtered().some(option => String(option.value) === @js((string) $value))"
>
	@if ($renderLabel)
		<span
			class="whitespace-nowrap"
		>
			{!! $label !!}
		</span>
	@else
		<span
			class="grow whitespace-nowrap"
		>
			{{ $label }}
		</span>
	@endif
	@if ($displayValue)
		<span
			class="text-muted-foreground min-w-0 truncate whitespace-nowrap"
			title="{{ $value }}"
		>
			{{ $value }}
		</span>
	@endif
	<x-narsil::ui.combobox.combobox-item-indicator
		:value="$value"
	/>
</button>

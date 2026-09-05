<button
	{{ $attributes->twMerge(
	        'relative flex w-full cursor-pointer items-center gap-2 rounded-md py-1 pr-8 pl-1.5 text-left text-sm outline-none hover:bg-accent hover:text-accent-foreground',
	    )->merge([
	        'data-slot' => 'combobox-item',
	        'role' => 'option',
	        'type' => 'button',
	    ]) }}
	x-bind:aria-selected="selected(@js($value))"
	x-on:click="select(@js($value))"
	x-show="filtered().some(option => String(option.value) === @js((string) $value))"
>
	@if ($icon)
		<x-narsil::ui.icon.icon-root
			:name="$icon"
			class="size-4"
		/>
	@endif
	<span
		class="grow whitespace-nowrap"
	>
		{{ $label }}
	</span>
	@if ($displayValue)
		<span
			class="text-muted-foreground"
		>
			{{ $value }}
		</span>
	@endif
	<x-narsil::ui.combobox.combobox-item-indicator
		:value="$value"
	/>
</button>

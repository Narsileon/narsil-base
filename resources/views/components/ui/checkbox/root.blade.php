@props([
    'checked' => false,
    'disabled' => false,
])

<button
	{{ $attributes->twMerge(
	        'peer relative flex size-4 shrink-0 cursor-pointer items-center justify-center rounded-[4px] border bg-accent/50 ring-1 ring-transparent transition-all outline-none after:absolute after:-inset-x-3 after:-inset-y-2 aria-invalid:border-destructive aria-invalid:ring-destructive data-checked:border-primary data-checked:bg-primary data-checked:text-primary-foreground disabled:cursor-not-allowed disabled:opacity-50 focus-visible:border-primary focus-visible:ring-primary group-has-disabled/field:opacity-50',
	    )->merge([
	        'data-slot' => 'checkbox-root',
	        'role' => 'checkbox',
	        'type' => 'button',
	    ]) }}
	@disabled($disabled)
	aria-checked="{{ $checked ? 'true' : 'false' }}"
	x-bind:aria-checked="checked ? 'true' : 'false'"
	x-bind:data-checked="checked ? 'true' : 'false'"
	x-data="{ checked: @js((bool) $checked) }"
	x-modelable="checked"
	x-on:click="checked = !checked"
>
	<span
		class="grid place-content-center text-current transition-none"
		data-slot="checkbox-indicator"
		x-cloak
		x-show="checked"
	>
		<x-narsil::ui.icon.root
			class="size-3.5 text-current"
			name="check"
		/>
	</span>
</button>

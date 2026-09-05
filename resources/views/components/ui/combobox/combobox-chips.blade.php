<div
	{{ $attributes->twMerge(
	        'flex min-h-9 flex-wrap items-center gap-1 rounded-md border border-border bg-accent/50 p-1 pl-2.5 text-sm focus-within:border-primary focus-within:ring-primary',
	    )->merge([
	        'data-slot' => 'combobox-chips',
	    ]) }}
	x-on:click="$refs['combobox-input']?.focus(); $store.narsilDropdown.open(dropdownId)"
	x-ref="combobox-trigger"
>
	{{ $slot }}
</div>

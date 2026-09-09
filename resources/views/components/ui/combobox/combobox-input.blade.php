<input
	{{ $attributes->twMerge('h-7 min-w-20 flex-1 bg-transparent p-0 text-sm outline-none placeholder:text-muted-foreground')->merge([
	        'data-slot' => 'combobox-input',
	        'placeholder' => $placeholder,
	        'type' => 'text',
	    ]) }}
	x-model="search"
	x-on:focus="$store.narsilDropdown.open(dropdownId)"
	x-on:input="if (virtualized) { const list = $refs['combobox-list']; if (list) list.scrollTop = 0; $nextTick(() => updateVirtualWindow()); } fetchOptions()"
	x-ref="combobox-input"
>

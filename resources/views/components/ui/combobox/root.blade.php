@props(['name', 'options' => [], 'placeholder' => '', 'required' => false, 'value' => ''])

<div
	{{ $attributes->twMerge('relative')->merge(['data-slot' => 'combobox-root']) }}
	x-data="{ open: false, search: @js($value) }"
>
	<input
		@required($required)
		class="border-border bg-accent/50 focus-visible:border-primary focus-visible:ring-primary h-9 w-full rounded-md border px-3 text-sm outline-none"
		name="{{ $name }}"
		placeholder="{{ $placeholder }}"
		type="text"
		value="{{ $value }}"
		x-model="search"
		x-on:focus="open = true"
	>
	<div
		class="bg-popover text-popover-foreground absolute inset-x-0 top-full z-10 mt-1 max-h-56 overflow-auto rounded-md border p-1 shadow-md"
		x-cloak
		x-on:click.outside="open = false"
		x-show="open"
	>
		@foreach ($options as $option)
			<button
				class="hover:bg-accent flex w-full rounded-md px-2 py-1.5 text-left text-sm"
				type="button"
				x-on:click="search = @js($option->value); open = false"
				x-show="!search || @js(strtolower(strip_tags($option->label))).includes(search.toLowerCase())"
			>
				{{ strip_tags($option->label) }}
			</button>
		@endforeach
	</div>
</div>

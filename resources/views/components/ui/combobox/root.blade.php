@props(['name', 'options' => [], 'placeholder' => '', 'required' => false, 'value' => ''])

<div
    {{ $attributes->twMerge('relative')->merge(['data-slot' => 'combobox-root']) }}
    x-data="{ open: false, search: @js($value) }"
>
    <input
        @required($required)
        class="h-9 w-full rounded-md border border-border bg-accent/50 px-3 text-sm outline-none focus-visible:border-primary focus-visible:ring-primary"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        type="text"
        value="{{ $value }}"
        x-model="search"
        x-on:focus="open = true"
    >
    <div
        class="absolute inset-x-0 top-full z-10 mt-1 max-h-56 overflow-auto rounded-md border bg-popover p-1 text-popover-foreground shadow-md"
        x-cloak
        x-on:click.outside="open = false"
        x-show="open"
    >
        @foreach ($options as $option)
            <button
                class="flex w-full rounded-md px-2 py-1.5 text-left text-sm hover:bg-accent"
                type="button"
                x-on:click="search = @js($option->value); open = false"
                x-show="!search || @js(strtolower(strip_tags($option->label))).includes(search.toLowerCase())"
            >
                {{ strip_tags($option->label) }}
            </button>
        @endforeach
    </div>
</div>

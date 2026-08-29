@props(['checked' => false, 'disabled' => false, 'name', 'required' => false, 'value' => '1'])

<label
    {{ $attributes->twMerge('inline-flex cursor-pointer items-center gap-2')->merge(['data-slot' => 'switch-root']) }}
    x-data="{ checked: @js($checked) }"
>
    <input
        @checked($checked)
        @disabled($disabled)
        @required($required)
        class="peer sr-only"
        name="{{ $name }}"
        type="checkbox"
        value="{{ $value }}"
        x-model="checked"
    >
    <span class="relative inline-flex h-4.5 w-8.5 shrink-0 rounded-full border border-transparent bg-border ring-1 ring-transparent transition-all peer-checked:bg-constructive peer-focus-visible:border-primary peer-focus-visible:ring-primary peer-disabled:cursor-not-allowed peer-disabled:opacity-50 after:block after:size-4 after:rounded-full after:bg-background after:transition-transform peer-checked:after:translate-x-full"></span>
    {{ $slot }}
</label>

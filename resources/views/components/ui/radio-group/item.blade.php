@props(['checked' => false, 'disabled' => false, 'name', 'required' => false, 'value'])

<label {{ $attributes->twMerge('flex items-center gap-2')->merge(['data-slot' => 'radio-group-item']) }}>
    <input
        @checked($checked)
        @disabled($disabled)
        @required($required)
        class="size-4 accent-primary"
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
    >
    {{ $slot }}
</label>

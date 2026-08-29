@props(['max' => 100, 'min' => 0, 'name', 'step' => 1, 'value' => 0])

<input
    {{ $attributes->twMerge('h-2 w-full cursor-pointer accent-primary')->merge(['data-slot' => 'slider-root', 'name' => $name]) }}
    max="{{ $max }}"
    min="{{ $min }}"
    step="{{ $step }}"
    type="range"
    value="{{ $value }}"
>

@props(['input', 'id', 'value' => 0])

<x-narsil::ui.slider.root
    :max="$input->max ?? 100"
    :min="$input->min ?? 0"
    :name="$id"
    :step="$input->step ?? 1"
    :value="$value"
/>

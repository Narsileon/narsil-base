@props(['element', 'id', 'value' => false])

<x-narsil::ui.field.label :required="$element->required ?? false" for="{{ $id }}">
    <input
        @checked($value)
        @disabled($element->readOnly ?? false)
        @required($element->required ?? false)
        id="{{ $id }}"
        name="{{ $id }}"
        type="checkbox"
        value="1"
    >
    <span class="ml-2">{{ $element->label }}</span>
</x-narsil::ui.field.label>

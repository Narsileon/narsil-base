@props(['element', 'input', 'id', 'type' => 'text', 'value' => ''])

<x-narsil::ui.input-group.root>
    <x-narsil::ui.input-group.input
        :autocomplete="$input->autoComplete ?? 'off'"
        :maxlength="$input->maxLength ?? null"
        :minlength="$input->minLength ?? null"
        :name="$id"
        :placeholder="$input->placeholder ?? null"
        :readonly="$element->readOnly ?? false"
        :required="$element->required ?? false"
        :type="$type"
        :value="$value"
        id="{{ $id }}"
    />
    @if ($element->icon ?? null)
        <x-narsil::ui.input-group.addon align="inline-end">
            <x-narsil::ui.icon.root class="opacity-50" :name="$element->icon" />
        </x-narsil::ui.input-group.addon>
    @endif
</x-narsil::ui.input-group.root>

@props(['languages' => [], 'value' => null])

<div
    {{ $attributes->twMerge('grid gap-1 border-b p-2')->merge(['data-slot' => 'form-language']) }}
>
    <div class="flex items-center gap-2 pl-2.5">
        <x-narsil::ui.icon.root name="fa-solid-globe" />
        <x-narsil::ui.heading.root level="h3" variant="discreet">
            {{ trans('narsil::ui.translations') }}
        </x-narsil::ui.heading.root>
    </div>
    <x-narsil::ui.form.field-language :languages="$languages" :value="$value" />
</div>

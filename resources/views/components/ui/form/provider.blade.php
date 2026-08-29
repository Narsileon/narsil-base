@props([
    'defaultLanguage' => 'en',
    'languages' => [],
])

<div
    {{ $attributes->merge(['data-slot' => 'form-provider']) }}
    x-data="{ formLanguage: @js($defaultLanguage), languages: @js($languages) }"
>
    {{ $slot }}
</div>

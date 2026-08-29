@props(['multiple' => false, 'name', 'options' => [], 'required' => false, 'value' => null])

<select
    {{ $attributes->twMerge('h-9 w-full rounded-md border border-border bg-accent/50 px-3 text-sm outline-none focus-visible:border-primary focus-visible:ring-primary')->merge(['data-slot' => 'select-root', 'name' => $name]) }}
    @if ($multiple)
        multiple
    @endif
    @required($required)
>
    @foreach ($options as $option)
        <option @selected((string) $value === (string) $option->value) value="{{ $option->value }}">{{ strip_tags($option->label) }}</option>
    @endforeach
</select>

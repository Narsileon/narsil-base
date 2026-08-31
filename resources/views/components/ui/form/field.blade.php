@props(['element', 'orientation' => 'vertical'])

<x-narsil::ui.field.root
	:orientation="$orientation"
	:width="$element->width ?? 100"
	class="{{ $element->className ?? '' }}"
>
	{{ $slot }}
	@if ($element->description ?? null)
		<x-narsil::ui.field.description>
			{{ $element->description }}
		</x-narsil::ui.field.description>
	@endif
	@error($element->id)
		<x-narsil::ui.field.error>
			{{ $message }}
		</x-narsil::ui.field.error>
	@enderror
</x-narsil::ui.field.root>

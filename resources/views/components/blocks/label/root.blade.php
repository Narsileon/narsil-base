@props(['required' => false])

<x-narsil::ui.label.root
	{{ $attributes }}
>
	{{ $slot }}
	@if ($required)
		<x-narsil::ui.label.required />
	@endif
</x-narsil::ui.label.root>

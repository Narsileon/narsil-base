<x-narsil::ui.label.label-root
	{{ $attributes }}
>
	{{ $slot }}
	@if ($required)
		<x-narsil::ui.label.label-required />
	@endif
</x-narsil::ui.label.label-root>

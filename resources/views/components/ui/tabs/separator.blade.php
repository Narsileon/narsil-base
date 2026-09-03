@props(['orientation' => 'vertical'])

<x-narsil::ui.separator.root
	:orientation="$orientation"
	{{ $attributes }}
/>

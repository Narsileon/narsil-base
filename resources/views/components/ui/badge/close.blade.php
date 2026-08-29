@props(['icon' => 'x'])

<button
	{{ $attributes->twMerge('cursor-pointer')->merge([
	    'data-slot' => 'badge-close',
	    'type' => 'button',
	]) }}
>
	<x-narsil::ui.icon.root
		:name="$icon"
		class="hover:text-destructive size-3.5 text-current"
	/>
</button>

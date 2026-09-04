
<x-narsil::blocks.label.label-root
	:required="$required"
	{{ $attributes->twMerge('min-h-7 data-invalid:text-destructive')->merge([
	    'data-slot' => 'field-label',
	]) }}
>
	<span
		class="first-letter:uppercase"
	>
		{{ $slot }}
	</span>
</x-narsil::blocks.label.label-root>

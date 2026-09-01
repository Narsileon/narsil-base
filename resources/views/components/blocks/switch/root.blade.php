@props(['checked' => false, 'disabled' => false, 'name', 'required' => false, 'value' => '1'])

<x-narsil::ui.switch.root
	:checked="$checked"
	:disabled="$disabled"
	:name="$name"
	:required="$required"
	:value="$value"
	{{ $attributes }}
>
	<span
		class="h-4.5 w-8.5 bg-border peer-checked:bg-constructive peer-focus-visible:border-primary peer-focus-visible:ring-primary relative inline-flex shrink-0 rounded-full border border-transparent ring-1 ring-transparent transition-all peer-disabled:cursor-not-allowed peer-disabled:opacity-50"
	>
		<x-narsil::ui.switch.thumb
			class="group-data-[size=default]/switch:data-checked:translate-x-full group-data-[size=sm]/switch:data-checked:translate-x-full"
		/>
	</span>
	{{ $slot }}
</x-narsil::ui.switch.root>

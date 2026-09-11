<x-narsil::ui.switch.switch-root
	:checked="$checked"
	:disabled="$disabled"
	:name="$name"
	:required="$required"
	:value="$value"
	{{ $attributes }}
>
	<x-narsil::ui.switch.switch-track>
		<x-narsil::ui.switch.switch-thumb
			class="group-data-[size=default]/switch:data-checked:translate-x-full group-data-[size=sm]/switch:data-checked:translate-x-full"
		/>
	</x-narsil::ui.switch.switch-track>
	{{ $slot }}
</x-narsil::ui.switch.switch-root>

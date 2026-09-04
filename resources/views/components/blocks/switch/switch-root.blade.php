
<x-narsil::ui.switch.switch-root
	:checked="$checked"
	:disabled="$disabled"
	:name="$name"
	:required="$required"
	:value="$value"
	{{ $attributes }}
>
	<span
		class="relative inline-flex h-4.5 w-8.5 shrink-0 rounded-full border border-transparent bg-border ring-1 ring-transparent transition-all peer-checked:bg-constructive peer-checked:[&>span]:translate-x-full peer-focus-visible:border-primary peer-focus-visible:ring-primary peer-disabled:cursor-not-allowed peer-disabled:opacity-50"
	>
		<x-narsil::ui.switch.switch-thumb
			class="group-data-[size=default]/switch:data-checked:translate-x-full group-data-[size=sm]/switch:data-checked:translate-x-full"
		/>
	</span>
	{{ $slot }}
</x-narsil::ui.switch.switch-root>

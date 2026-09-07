<x-narsil::ui.input-group.input-group-root
	class="bg-background m-0 rounded-b-none border-x-0 border-t-0 px-2.5"
>
	<x-narsil::ui.combobox.combobox-input
		:disabled="$disabled"
		class="h-9 w-full"
		placeholder="{{ trans('narsil::placeholders.search') }}"
	/>
	@if ($clearable)
		<x-narsil::ui.combobox.combobox-clear
			:disabled="$disabled"
		/>
	@endif
</x-narsil::ui.input-group.input-group-root>

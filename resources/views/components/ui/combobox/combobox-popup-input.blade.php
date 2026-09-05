<div
	class="border-border flex h-9 items-center border-b px-2"
>
	<x-narsil::ui.combobox.combobox-input
		:disabled="$disabled"
		class="w-full"
		placeholder="{{ trans('narsil::placeholders.search') }}"
	/>
	@if ($clearable)
		<x-narsil::ui.combobox.combobox-clear
			:disabled="$disabled"
		/>
	@endif
</div>

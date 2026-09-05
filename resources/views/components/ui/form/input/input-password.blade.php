<div
	class="relative"
	x-data="{ show: false }"
>
	<x-narsil::ui.input-group.input-group-root>
		<x-narsil::ui.input-group.input-group-input
			:autocomplete="$input->autoComplete ?? 'off'"
			:maxlength="$input->maxLength ?? null"
			:minlength="$input->minLength ?? null"
			:name="$id"
			:readonly="$element->readOnly ?? false"
			:required="$element->required ?? false"
			id="{{ $id }}"
			type="password"
			x-bind:type="show ? 'text' : 'password'"
		/>
		<x-narsil::ui.input-group.input-group-button
			size="default"
			type="button"
			x-on:click="show = !show"
		>
			<x-narsil::ui.icon.icon-root
				name="eye"
				x-show="!show"
			/>
			<x-narsil::ui.icon.icon-root
				name="eye-off"
				x-cloak
				x-show="show"
			/>
		</x-narsil::ui.input-group.input-group-button>
	</x-narsil::ui.input-group.input-group-root>
	@if ($input->href ?? null)
		<a
			class="text-muted-foreground hover:text-foreground absolute -top-8 right-0 text-sm underline-offset-4 hover:underline"
			href="{{ $input->href }}"
		>
			{{ trans('narsil::ui.forgot_password') }}
		</a>
	@endif
</div>

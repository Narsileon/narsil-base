<x-narsil::ui.card.card-header
	class="border-b"
>
	<x-narsil::ui.card.card-title>
		{{ trans('narsil::bookmarks.menu') }}
	</x-narsil::ui.card.card-title>
</x-narsil::ui.card.card-header>
<x-narsil::ui.card.card-content>
	<form
		class="grid gap-4"
		method="POST"
		x-bind:action="`{{ $updateUrl }}`.replace('__bookmark__', editing?.uuid)"
	>
		@csrf
		@method('PATCH')
		<x-narsil::ui.field.field-root>
			<x-narsil::ui.field.field-label
				for="bookmark-name"
			>
				{{ trans('narsil::validation.attributes.name') }}
			</x-narsil::ui.field.field-label>
			<x-narsil::ui.input.input-root
				id="bookmark-name"
				name="name"
				required
				x-bind:value="editing?.name"
			/>
		</x-narsil::ui.field.field-root>
		<div
			class="flex justify-end gap-2"
		>
			<x-narsil::ui.button.button-root
				type="button"
				variant="secondary"
				x-on:click="editing = null"
			>
				{{ trans('narsil::ui.cancel') }}
			</x-narsil::ui.button.button-root>
			<x-narsil::ui.button.button-root
				type="submit"
			>
				{{ trans('narsil::ui.save') }}
			</x-narsil::ui.button.button-root>
		</div>
	</form>
</x-narsil::ui.card.card-content>

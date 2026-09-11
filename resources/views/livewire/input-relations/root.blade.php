<div
	class="min-w-0"
	data-slot="input-relations"
>
	@foreach ($fields as $field)
		<input
			name="{{ $field['name'] }}"
			type="hidden"
			value="{{ $field['value'] }}"
		>
	@endforeach
	@include('narsil::livewire.input-relations.list', ['list' => $list])
	@if ($editor !== null)
		@teleport('body')
			<div
				wire:key="relation-editor-{{ $editor['key'] }}"
				x-data="narsilRelationEditor()"
				x-on:dialog-close.stop="close()"
			>
				<x-narsil::ui.dialog.dialog-backdrop />
				<x-narsil::ui.dialog.dialog-popup
					class="flex max-h-[calc(100dvh-2rem)] flex-col"
				>
					<x-narsil::ui.dialog.dialog-header
						class="shrink-0 border-b"
					>
						<x-narsil::ui.dialog.dialog-title>
							{{ data_get($editor, 'item.handle', trans('narsil::ui.add')) }}
						</x-narsil::ui.dialog.dialog-title>
					</x-narsil::ui.dialog.dialog-header>
					<form
						class="flex min-h-0 flex-col"
						x-on:submit.prevent="save($el)"
					>
						<x-narsil::ui.form.form-provider
							:default-language="app()->getLocale()"
							:languages="$editorLanguages"
							class="flex min-h-0 flex-col"
						>
							<x-narsil::ui.form.form-tabs
								:form-data="$editor['item']"
								:languages="$editorLanguages"
								:steps="$editorForm->steps ?? []"
							/>
						</x-narsil::ui.form.form-provider>
						@if ($errors->any())
							<div
								class="text-destructive px-4 pb-4 text-sm"
								role="alert"
							>
								{{ $errors->first() }}
							</div>
						@endif
						<x-narsil::ui.dialog.dialog-footer
							class="shrink-0 border-t"
						>
							<x-narsil::ui.button.button-root
								variant="ghost"
								x-bind:disabled="busy"
								x-on:click="close()"
							>
								{{ trans('narsil::ui.cancel') }}
							</x-narsil::ui.button.button-root>
							<x-narsil::ui.button.button-root
								type="submit"
								x-bind:disabled="busy"
							>
								{{ trans('narsil::ui.save') }}
							</x-narsil::ui.button.button-root>
						</x-narsil::ui.dialog.dialog-footer>
					</form>
				</x-narsil::ui.dialog.dialog-popup>
			</div>
		@endteleport
	@endif
</div>

<x-narsil::ui.alert-dialog.alert-dialog-root
	:open="$open"
>
	@if (trim((string) $slot) !== '')
		<x-narsil::ui.alert-dialog.alert-dialog-trigger>
			{{ $slot }}
		</x-narsil::ui.alert-dialog.alert-dialog-trigger>
	@endif
	<x-narsil::ui.alert-dialog.alert-dialog-portal>
		<x-narsil::ui.alert-dialog.alert-dialog-backdrop />
		<x-narsil::ui.alert-dialog.alert-dialog-popup>
			<x-narsil::ui.alert-dialog.alert-dialog-header>
				<x-narsil::ui.alert-dialog.alert-dialog-title>
					{{ $title ?? trans('narsil::dialogs.titles.default') }}
				</x-narsil::ui.alert-dialog.alert-dialog-title>
				<x-narsil::ui.alert-dialog.alert-dialog-description>
					{{ $description ?? trans('narsil::dialogs.descriptions.default') }}
				</x-narsil::ui.alert-dialog.alert-dialog-description>
			</x-narsil::ui.alert-dialog.alert-dialog-header>
			<x-narsil::ui.alert-dialog.alert-dialog-footer>
				<div
					class="flex items-center gap-2"
				>
					@foreach ($actions as $action)
						@if (($action['method'] ?? 'GET') === 'DELETE')
							<form
								action="{{ $action['href'] ?? '' }}"
								method="POST"
							>
								@csrf @method('DELETE')
								<x-narsil::ui.alert-dialog.alert-dialog-action
									type="submit"
								>
									{{ $action['label'] ?? trans('narsil::ui.confirm') }}
								</x-narsil::ui.alert-dialog.alert-dialog-action>
							</form>
						@else
							<x-narsil::ui.alert-dialog.alert-dialog-action
								:href="$action['href'] ?? null"
							>
								{{ $action['label'] ?? trans('narsil::ui.confirm') }}
							</x-narsil::ui.alert-dialog.alert-dialog-action>
						@endif
					@endforeach
				</div>
				<x-narsil::ui.alert-dialog.alert-dialog-cancel>
					{{ $cancel['label'] ?? trans('narsil::ui.cancel') }}
				</x-narsil::ui.alert-dialog.alert-dialog-cancel>
			</x-narsil::ui.alert-dialog.alert-dialog-footer>
		</x-narsil::ui.alert-dialog.alert-dialog-popup>
	</x-narsil::ui.alert-dialog.alert-dialog-portal>
</x-narsil::ui.alert-dialog.alert-dialog-root>

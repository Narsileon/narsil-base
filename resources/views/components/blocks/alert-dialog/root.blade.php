@props([
    'actions' => [],
    'cancel' => [],
    'description' => null,
    'open' => false,
    'title' => null,
])

<x-narsil::ui.alert-dialog.root
	:open="$open"
>
	@if (trim((string) $slot) !== '')
		<x-narsil::ui.alert-dialog.trigger>
			{{ $slot }}
		</x-narsil::ui.alert-dialog.trigger>
	@endif
	<x-narsil::ui.alert-dialog.portal>
		<x-narsil::ui.alert-dialog.backdrop />
		<x-narsil::ui.alert-dialog.popup>
			<x-narsil::ui.alert-dialog.header>
				<x-narsil::ui.alert-dialog.title>
					{{ $title ?? trans('narsil::dialogs.titles.default') }}
				</x-narsil::ui.alert-dialog.title>
				<x-narsil::ui.alert-dialog.description>
					{{ $description ?? trans('narsil::dialogs.descriptions.default') }}
				</x-narsil::ui.alert-dialog.description>
			</x-narsil::ui.alert-dialog.header>
			<x-narsil::ui.alert-dialog.footer>
				<div
					class="flex items-center gap-2"
				>
					@foreach ($actions as $action)
						<x-narsil::ui.alert-dialog.action
							:href="$action['href'] ?? null"
						>
							{{ $action['label'] ?? trans('narsil::ui.confirm') }}
						</x-narsil::ui.alert-dialog.action>
					@endforeach
				</div>
				<x-narsil::ui.alert-dialog.cancel>
					{{ $cancel['label'] ?? trans('narsil::ui.cancel') }}
				</x-narsil::ui.alert-dialog.cancel>
			</x-narsil::ui.alert-dialog.footer>
		</x-narsil::ui.alert-dialog.popup>
	</x-narsil::ui.alert-dialog.portal>
</x-narsil::ui.alert-dialog.root>

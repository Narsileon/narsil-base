<div
	{{ $attributes->merge(['data-slot' => 'resource-modal']) }}
	data-resource-url="{{ $url }}"
	x-data="narsilResourceModal()"
>
	<x-narsil::ui.button.button-root
		x-on:click="open()"
	>
		{{ trans('narsil::ui.create') }}
	</x-narsil::ui.button.button-root>
	<template
		x-teleport="body"
	>
		<div
			x-on:dialog-close.stop="close()"
			x-on:submit.prevent="submit($event)"
		>
			<x-narsil::ui.dialog.dialog-backdrop />
			<x-narsil::ui.dialog.dialog-popup
				class="flex max-h-[calc(100dvh-2rem)] max-w-3xl flex-col"
			>
				<x-narsil::ui.dialog.dialog-header
					class="shrink-0 border-b"
				>
					<x-narsil::ui.dialog.dialog-title>{{ $title }}</x-narsil::ui.dialog.dialog-title>
				</x-narsil::ui.dialog.dialog-header>
				<div
					class="flex min-h-0 flex-col"
					x-bind:inert="busy"
					x-html="html"
				></div>
				<div
					class="text-destructive p-4 text-sm"
					role="alert"
					x-show="error"
					x-text="error"
				></div>
			</x-narsil::ui.dialog.dialog-popup>
		</div>
	</template>
</div>

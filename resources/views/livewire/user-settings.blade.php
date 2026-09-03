<div
	x-data="{
    applyColor(color) {
            document.documentElement.dataset.color = color;
            localStorage.setItem('narsil:color', JSON.stringify({ state: { color: color }, version: 0 }));
        },
        applyRadius(radius) {
            document.documentElement.style.setProperty('--radius', `${radius}rem`);
            localStorage.setItem('narsil:radius', JSON.stringify({ state: { radius: Number(radius) }, version: 0 }));
        }
}"
	x-on:dynamic-form-input.window="if ($event.detail.id === 'radius') applyRadius($event.detail.value)"
	x-on:open-user-settings.window="$dispatch('dialog-open')"
	x-on:select-change.window="if ($event.detail.id === 'color') applyColor($event.detail.value)"
>
	<x-narsil::ui.dialog.root
		:open="session('narsil_user_settings_open', false)"
		wire:ignore.self
		x-on:open-user-settings.window="open = true"
	>
		<x-narsil::ui.dialog.backdrop />
		<x-narsil::ui.dialog.popup
			aria-labelledby="user-settings-title"
			class="pointer-events-auto max-w-lg"
		>
			<x-narsil::ui.dialog.header
				class="border-b px-6"
			>
				<x-narsil::ui.dialog.title
					id="user-settings-title"
				>
					{{ trans('narsil::ui.personalization') }}
				</x-narsil::ui.dialog.title>
			</x-narsil::ui.dialog.header>
			<form
				class="grid gap-4 p-6"
				wire:submit="save"
			>
				<x-narsil::blocks.dynamic-form
					:form="$form"
					:values="['color' => $color, 'language' => $language, 'radius' => $radius]"
				/>
				<x-narsil::ui.dialog.footer
					class="-mx-6 -mb-6 border-t"
				>
					<x-narsil::ui.dialog.close
						class="hover:bg-accent inline-flex h-9 items-center justify-center rounded-md px-3 text-sm font-medium"
					>
						{{ trans('narsil::ui.cancel') }}
					</x-narsil::ui.dialog.close>
					<x-narsil::ui.button.root
						type="submit"
						wire:loading.attr="disabled"
						wire:target="save"
					>
						{{ trans('narsil::ui.save') }}
					</x-narsil::ui.button.root>
				</x-narsil::ui.dialog.footer>
			</form>
		</x-narsil::ui.dialog.popup>
	</x-narsil::ui.dialog.root>
</div>

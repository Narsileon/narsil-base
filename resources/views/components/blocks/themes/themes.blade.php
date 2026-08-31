<div
	x-data="{
    theme: @js($theme),
    applyTheme(theme) {
        const isDark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        document.documentElement.classList.toggle('dark', isDark);
        document.documentElement.classList.toggle('light', !isDark);
    }
}"
	x-init="applyTheme(theme)"
	x-on:theme-updated.window="theme = $event.detail.theme; applyTheme(theme); $dispatch('toggle-group-select', { value: theme })"
	x-on:toggle-group-change.window="$wire.setTheme($event.detail.value)"
>
	<x-narsil::ui.toggle-group.root
		:selected="$theme"
		class="w-auto justify-start"
		size="icon"
		variant="outline"
	>
		@foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'sun-moon'] as $theme => $icon)
			<x-narsil::ui.toggle-group.item
				aria-label="{{ trans('narsil::themes.' . $theme) }}"
				size="icon"
				value="{{ $theme }}"
				variant="outline"
			>
				<x-narsil::ui.icon.root
					:name="$icon"
					class="text-primary size-5"
				/>
			</x-narsil::ui.toggle-group.item>
		@endforeach
	</x-narsil::ui.toggle-group.root>
</div>

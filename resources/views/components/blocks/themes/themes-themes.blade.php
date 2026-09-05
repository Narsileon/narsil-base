<div
	x-data="{
    theme: @js($theme),
    resolveTheme(theme) {
        return theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ? 'dark'
            : 'light';
    },
    applyTheme(theme) {
        const resolvedTheme = this.resolveTheme(theme);
        document.documentElement.classList.toggle('dark', resolvedTheme === 'dark');
        document.documentElement.classList.toggle('light', resolvedTheme === 'light');
    },
    transitionTheme(theme, trigger) {
        const apply = () => this.applyTheme(theme);

        if (!document.startViewTransition) {
            apply();

            return;
        }

        const transition = document.startViewTransition(apply);

        transition.ready.then(() => {
            if (!trigger) {
                return;
            }

            const rect = trigger.getBoundingClientRect();
            const x = rect.left + rect.width / 2;
            const y = rect.top + rect.height / 2;
            const maxRadius = Math.hypot(
                Math.max(x, window.innerWidth - x),
                Math.max(y, window.innerHeight - y),
            );

            document.documentElement.animate(
                {
                    clipPath: [
                        `circle(0px at ${x}px ${y}px)`,
                        `circle(${maxRadius}px at ${x}px ${y}px)`,
                    ],
                },
                {
                    duration: 800,
                    easing: 'ease-in-out',
                    pseudoElement: '::view-transition-new(root)',
                },
            );
        });
    },
    selectTheme(theme, trigger) {
        this.theme = theme;
        this.transitionTheme(theme, trigger);
    }
}"
	x-init="applyTheme(theme)"
	x-on:theme-updated.window="theme = $event.detail.theme; applyTheme(theme); $dispatch('toggle-group-select', { value: theme })"
	x-on:toggle-group-change.window="selectTheme($event.detail.value, $event.target); $wire.setTheme($event.detail.value)"
>
	<x-narsil::ui.toggle-group.toggle-group-root
		:selected="$theme"
		class="w-auto justify-center"
		size="icon"
		variant="outline"
	>
		@foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'sun-moon'] as $theme => $icon)
			<x-narsil::ui.toggle-group.toggle-group-item
				aria-label="{{ trans('narsil::themes.' . $theme) }}"
				size="icon"
				value="{{ $theme }}"
				variant="outline"
			>
				<x-narsil::ui.icon.icon-root
					:name="$icon"
					class="text-primary size-5"
				/>
			</x-narsil::ui.toggle-group.toggle-group-item>
		@endforeach
	</x-narsil::ui.toggle-group.toggle-group-root>
</div>

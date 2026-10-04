<div
	{{ $attributes->twMerge()->merge([
	    'data-slot' => 'themes-themes',
	]) }}
	x-data="narsilTheme(@js($theme), theme => $wire.setTheme(theme))"
>
	<x-narsil::ui.dropdown-menu.dropdown-menu-submenu-root>
		<x-narsil::ui.dropdown-menu.dropdown-menu-submenu-trigger
			aria-haspopup="menu"
			class="h-9 w-full justify-between"
			x-bind:aria-expanded="dropdownSubmenuOpen"
		>
			<span class="inline-flex items-center gap-2">
				<x-narsil::ui.icon.icon-root
					class="text-primary size-5"
					name="fa-solid-palette"
				/>
				{{ trans('narsil::ui.theme') }}
			</span>
			<x-narsil::ui.icon.icon-root
				class="size-4"
				name="fa-solid-chevron-right"
			/>
		</x-narsil::ui.dropdown-menu.dropdown-menu-submenu-trigger>
		<x-narsil::ui.dropdown-menu.dropdown-menu-portal x-on:click.stop="">
			<x-narsil::ui.dropdown-menu.dropdown-menu-submenu-positioner>
				<x-narsil::ui.dropdown-menu.dropdown-menu-submenu-popup
					class="border"
					x-on:mouseleave="if (!themeTransitioning) dropdownSubmenuOpen = false"
				>
					<x-narsil::ui.dropdown-menu.dropdown-menu-radio-group>
						@foreach ([
							'light' => 'fa-regular-sun',
							'dark' => 'fa-regular-moon',
							'system' => 'fa-solid-circle-half-stroke',
						] as $theme => $icon)
							<x-narsil::ui.dropdown-menu.dropdown-menu-radio-item
								data-theme="{{ $theme }}"
								class="h-9 w-full pr-8 pl-3"
								wire:key="theme-option-{{ $theme }}"
								x-bind:aria-checked="theme === $el.dataset.theme"
								x-on:click="selectTheme($el.dataset.theme, $event.currentTarget)"
							>
								<x-narsil::ui.icon.icon-root
									class="text-primary size-5"
									:name="$icon"
								/>
								{{ trans('narsil::themes.' . $theme) }}
								<x-narsil::ui.dropdown-menu.dropdown-menu-radio-item-indicator
									x-show="theme === $el.parentElement.dataset.theme"
								>
									<x-narsil::ui.icon.icon-root name="fa-solid-check" />
								</x-narsil::ui.dropdown-menu.dropdown-menu-radio-item-indicator>
							</x-narsil::ui.dropdown-menu.dropdown-menu-radio-item>
						@endforeach
					</x-narsil::ui.dropdown-menu.dropdown-menu-radio-group>
				</x-narsil::ui.dropdown-menu.dropdown-menu-submenu-popup>
			</x-narsil::ui.dropdown-menu.dropdown-menu-submenu-positioner>
		</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
	</x-narsil::ui.dropdown-menu.dropdown-menu-submenu-root>
</div>

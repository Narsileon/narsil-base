<!DOCTYPE
	html
>
<html
	lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>

<head>
	<meta
		charset="utf-8"
	>
	<meta
		content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
		name="viewport"
	>
	<link
		href="/favicon.svg"
		rel="icon"
	>
	<script>
		(() => {
			const theme = @js(session(\Narsil\Base\Models\Users\UserConfiguration::THEME, \Narsil\Base\Enums\ThemeEnum::SYSTEM->value));
			const isDark = theme === 'dark' || (theme === 'system' && window.matchMedia(
				'(prefers-color-scheme: dark)').matches);
			const root = document.documentElement;

			root.classList.toggle('dark', isDark);
			root.classList.toggle('light', !isDark);

			const storedColor = JSON.parse(localStorage.getItem('narsil:color') || 'null');
			const storedRadius = JSON.parse(localStorage.getItem('narsil:radius') || 'null');

			if (storedColor?.state?.color)
				root.dataset.color = storedColor.state.color;

			if (storedRadius?.state?.radius !== undefined)
				root.style.setProperty('--radius', `${storedRadius.state.radius}rem`);
		})();
	</script>
	@vite(['resources/css/backend.css', 'resources/js/livewire.ts'])
	@livewireStyles
</head>

<body
	class="bg-background text-foreground min-h-screen antialiased"
>
	<x-narsil::blocks.sidebar.provider>
		@if ($auth)
			<x-narsil::blocks.sidebar.root
				:name="$sidebarName"
				:navigation="$navigation"
				:sidebar="data_get($navigation, 'sidebars.' . $sidebarName, [])"
			/>
		@endif
		<main
			class="relative flex min-h-svh min-w-0 flex-1 flex-col overflow-hidden"
		>
			<header
				class="h-13 bg-background sticky top-0 z-10 flex items-center border-b shadow"
			>
				<div
					class="text-foreground flex h-full w-full items-center gap-2 px-2 xl:px-4"
				>
					@if ($auth)
						<x-narsil::blocks.breadcrumb.root
							:breadcrumb="data_get($navigation, 'breadcrumb', [])"
							class="grow"
						/>
						@if (count(data_get($session, 'schemas', [])) > 1)
							<form
								action="{{ route('user-configurations.update') }}"
								method="POST"
								x-on:select-change="if ($event.detail.id === 'workspace') $el.submit()"
							>
								@csrf
								<x-narsil::blocks.select.root
									:id="'workspace'"
									:name="'schema'"
									:options="data_get($session, 'schemas', [])"
									:value="data_get($session, 'schema')"
									class="min-w-24"
								/>
							</form>
						@endif
						<x-narsil::blocks.bookmarks.root
							:breadcrumb="data_get($navigation, 'breadcrumb', [])"
						/>
					@else
						<x-narsil::ui.logo.root
							:show-name="false"
						/>
						<div
							class="grow"
						></div>
					@endif
					<x-narsil::ui.dropdown-menu.root>
						<x-narsil::ui.dropdown-menu.trigger
							aria-label="{{ trans('narsil-cms::accessibility.user_menu') }}"
							class="hover:bg-accent hover:text-primary focus-visible:ring-ring inline-flex size-9 items-center justify-center rounded-full transition-colors focus-visible:outline-none focus-visible:ring-2"
						>
							<x-narsil::ui.avatar.root>
								@if (data_get($auth, 'avatar'))
									<x-narsil::ui.avatar.image
										:src="$auth->avatar"
										alt="{{ data_get($auth, 'full_name', 'User') }}"
									/>
								@endif
								<x-narsil::ui.avatar.fallback>
									<x-narsil::ui.icon.root
										name="user"
									/>
								</x-narsil::ui.avatar.fallback>
							</x-narsil::ui.avatar.root>
						</x-narsil::ui.dropdown-menu.trigger>
						<x-narsil::ui.dropdown-menu.positioner
							align="end"
						>
							<x-narsil::ui.dropdown-menu.popup
								class="border"
							>
								@foreach ($menu as $item)
									@if (($item['id'] ?? null) === 'settings')
										<x-narsil::ui.dropdown-menu.item
											x-on:click="$dispatch('open-user-settings'); $dispatch('dialog-open')"
										>
											<x-narsil::ui.icon.root
												:name="$item['icon'] ?? ''"
												class="text-primary size-5"
											/>
											{{ $item['label'] }}
										</x-narsil::ui.dropdown-menu.item>
									@else
										<x-narsil::ui.dropdown-menu.item
											:href="route($item['route'], $item['parameters'] ?? [])"
										>
											<x-narsil::ui.icon.root
												:name="$item['icon'] ?? ''"
												class="text-primary size-5"
											/>
											{{ $item['label'] }}
										</x-narsil::ui.dropdown-menu.item>
									@endif
								@endforeach
								<x-narsil::ui.dropdown-menu.separator />
								<div
									class="px-1 py-1"
								>
									<livewire:narsil-theme />
								</div>
							</x-narsil::ui.dropdown-menu.popup>
						</x-narsil::ui.dropdown-menu.positioner>
					</x-narsil::ui.dropdown-menu.root>
				</div>
			</header>
			<div
				class="relative min-h-0 grow overflow-y-auto"
			>
				@yield('body')
			</div>
		</main>
	</x-narsil::blocks.sidebar.provider>
	<livewire:narsil-user-settings />
	@livewireScriptConfig
</body>

</html>

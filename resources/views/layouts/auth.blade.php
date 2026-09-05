<!DOCTYPE
	html
>
<html
	data-color="{{ session(\Narsil\Base\Models\Users\UserConfiguration::COLOR, \Narsil\Base\Enums\ColorEnum::GRAY->value) }}"
	data-theme="{{ session(\Narsil\Base\Models\Users\UserConfiguration::THEME, \Narsil\Base\Enums\ThemeEnum::SYSTEM->value) }}"
	lang="{{ str_replace('_', '-', app()->getLocale()) }}"
	style="--radius: {{ session(\Narsil\Base\Models\Users\UserConfiguration::RADIUS, 0.25) }}rem;"
>

<head>
	<meta
		charset="utf-8"
	>
	<title>
		{{ $title ?? 'Narsil' }}
	</title>
	<meta
		content="{{ $description ?? '' }}"
		name="description"
	>
	<meta
		content="noindex, nofollow"
		name="robots"
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
			const root = document.documentElement;

			const applyAppearance = () => {
				const theme = root.dataset.theme;
				const isDark = theme === 'dark' || (theme === 'system' && window.matchMedia(
					'(prefers-color-scheme: dark)').matches);

				root.classList.toggle('dark', isDark);
				root.classList.toggle('light', !isDark);
			};

			applyAppearance();
			document.addEventListener('livewire:navigating', (event) => {
				event.detail.onSwap(applyAppearance);
			});
			document.addEventListener('livewire:navigated', applyAppearance);
		})();
	</script>
	@vite(['resources/css/backend.css', 'resources/js/livewire.ts'])
	@livewireStyles
</head>

<body
	class="bg-background text-foreground min-h-screen antialiased"
>
	<x-narsil::blocks.sidebar.sidebar-provider>
		@if ($auth)
			<x-narsil::blocks.sidebar.sidebar-root
				:name="$sidebarName"
				:navigation="$navigation"
				:sidebar="data_get($navigation, 'sidebars.' . $sidebarName, [])"
			/>
		@endif
		<main
			class="relative flex min-w-0 flex-1 flex-col overflow-hidden"
		>
			<header
				class="h-13 bg-background sticky top-0 z-10 flex items-center border-b shadow"
			>
				<div
					class="text-foreground flex h-full w-full items-center gap-2 pl-2 pr-4 md:pl-4"
				>
					@if ($auth)
						<button
							aria-label="{{ trans('narsil::ui.menu') }}"
							class="hover:bg-accent hover:text-primary inline-flex size-9 shrink-0 cursor-pointer items-center justify-center rounded-md transition-colors md:hidden"
							type="button"
							x-on:click="openSidebar()"
						>
							<x-narsil::ui.icon.icon-root
								name="bars"
							/>
						</button>
						<x-narsil::ui.separator.separator-root
							class="md:hidden"
							orientation="vertical"
						/>
						<x-narsil::blocks.breadcrumb.breadcrumb-root
							:breadcrumb="data_get($navigation, 'breadcrumb', [])"
							class="grow pl-2 md:pl-0"
						/>
						@if (count(data_get($session, 'schemas', [])) > 1)
							<form
								action="{{ route('user-configurations.update') }}"
								method="POST"
								x-on:select-change="if ($event.detail.id === 'workspace') $el.submit()"
							>
								@csrf
								<x-narsil::blocks.select.select-root
									:id="'workspace'"
									:name="'schema'"
									:options="data_get($session, 'schemas', [])"
									:value="data_get($session, 'schema')"
									class="min-w-24"
								/>
							</form>
						@endif
						<x-narsil::blocks.bookmarks.bookmarks-root
							:breadcrumb="data_get($navigation, 'breadcrumb', [])"
						/>
					@else
						<x-narsil::ui.logo.logo-root
							:show-name="false"
						/>
						<div
							class="grow"
						></div>
					@endif
					<x-narsil::ui.dropdown-menu.dropdown-menu-root>
						<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
							aria-label="{{ trans('narsil-cms::accessibility.user_menu') }}"
							class="hover:bg-accent hover:text-primary focus-visible:ring-ring inline-flex size-9 items-center justify-center rounded-full transition-colors focus-visible:outline-none focus-visible:ring-2"
						>
							<x-narsil::ui.avatar.avatar-root>
								@if (data_get($auth, 'avatar'))
									<x-narsil::ui.avatar.avatar-image
										:src="$auth->avatar"
										alt="{{ data_get($auth, 'full_name', 'User') }}"
									/>
								@endif
								<x-narsil::ui.avatar.avatar-fallback>
									<x-narsil::ui.icon.icon-root
										name="user"
									/>
								</x-narsil::ui.avatar.avatar-fallback>
							</x-narsil::ui.avatar.avatar-root>
						</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
						<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
							<x-narsil::ui.dropdown-menu.dropdown-menu-positioner
								align="end"
							>
								<x-narsil::ui.dropdown-menu.dropdown-menu-popup
									class="border"
								>
									@foreach ($menu as $item)
									@if (($item['id'] ?? null) === 'settings')
										<x-narsil::ui.dropdown-menu.dropdown-menu-item
											x-on:click="$dispatch('open-user-settings'); $dispatch('dialog-open')"
										>
											<x-narsil::ui.icon.icon-root
												:name="$item['icon'] ?? ''"
												class="text-primary size-5"
											/>
											{{ $item['label'] }}
										</x-narsil::ui.dropdown-menu.dropdown-menu-item>
									@elseif (
										($item['method'] ?? \Narsil\Base\Enums\RequestMethodEnum::GET->value) ===
											\Narsil\Base\Enums\RequestMethodEnum::GET->value)
										<x-narsil::ui.dropdown-menu.dropdown-menu-item
											:href="route($item['route'], $item['parameters'] ?? [])"
											wire:navigate
										>
											<x-narsil::ui.icon.icon-root
												:name="$item['icon'] ?? ''"
												class="text-primary size-5"
											/>
											{{ $item['label'] }}
										</x-narsil::ui.dropdown-menu.dropdown-menu-item>
									@else
										<form
											action="{{ route($item['route'], $item['parameters'] ?? []) }}"
											method="POST"
										>
											@csrf
											@if (
												($item['method'] ?? \Narsil\Base\Enums\RequestMethodEnum::GET->value) !==
													\Narsil\Base\Enums\RequestMethodEnum::POST->value)
												@method($item['method'])
											@endif
											<x-narsil::ui.dropdown-menu.dropdown-menu-item
												class="w-full"
												type="submit"
											>
												<x-narsil::ui.icon.icon-root
													:name="$item['icon'] ?? ''"
													class="text-primary size-5"
												/>
												{{ $item['label'] }}
											</x-narsil::ui.dropdown-menu.dropdown-menu-item>
										</form>
									@endif
									@endforeach
									<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
									<div
										class="px-1 py-1"
									>
										<livewire:narsil-theme />
									</div>
								</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
							</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
						</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
					</x-narsil::ui.dropdown-menu.dropdown-menu-root>
				</div>
			</header>
			<div
				class="relative h-[calc(100vh-3.25rem)] overflow-y-auto"
			>
				@yield('body')
			</div>
		</main>
	</x-narsil::blocks.sidebar.sidebar-provider>
	<livewire:narsil-user-settings />
	@if (session('success'))
		<x-narsil::blocks.toast.toast-root
			:messages="['success' => session('success')]"
		/>
	@endif
	@livewireScriptConfig
</body>

</html>

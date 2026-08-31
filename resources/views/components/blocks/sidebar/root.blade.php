@props(['sidebar' => [], 'name' => 'cms', 'navigation' => []])

<aside
	{{ $attributes->merge(['data-slot' => 'sidebar-root']) }}
	class="text-foreground group peer relative block h-svh shrink-0 transition-[width] duration-300 ease-linear"
	data-collapsible="icon"
	data-side="left"
	data-variant="sidebar"
	x-bind:data-state="open ? 'expanded' : 'collapsed'"
	x-bind:style="`width: ${open ? 'var(--sidebar-width)' : 'var(--sidebar-width-icon)'}`"
>
	<div
		class="relative h-full w-full bg-transparent"
	>
		<div
			class="w-(--sidebar-width) group-data-[state=collapsed]:w-(--sidebar-width-icon) fixed inset-y-0 left-0 z-10 hidden h-svh transition-[width] duration-300 ease-linear md:flex"
		>
			<div
				class="bg-sidebar text-foreground flex h-full w-full flex-col border-r"
			>
				<x-narsil::blocks.sidebar.header>
					<x-narsil::blocks.sidebar.switcher
						:items="data_get($navigation, 'home', [])"
					/>
				</x-narsil::blocks.sidebar.header>
				<x-narsil::blocks.sidebar.content
					:sidebar="$sidebar"
				/>
				<x-narsil::blocks.sidebar.footer />
			</div>
		</div>
	</div>
</aside>

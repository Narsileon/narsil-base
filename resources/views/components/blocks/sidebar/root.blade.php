@props(['sidebar' => [], 'name' => 'cms', 'navigation' => []])


<div
	class="fixed inset-0 z-40 md:hidden"
	x-cloak
	x-show="open"
>
	<div
		class="absolute inset-0 bg-black/50"
		x-on:click="toggleSidebar()"
		x-transition.opacity
	></div>
	<div
		class="bg-sidebar text-foreground relative flex h-full w-(--sidebar-width) flex-col border-r shadow-xl"
		x-on:click.stop
		x-show="open"
		x-transition:enter="transition-transform duration-300 ease-out"
		x-transition:enter-start="-translate-x-full"
		x-transition:enter-end="translate-x-0"
		x-transition:leave="transition-transform duration-300 ease-in"
		x-transition:leave-start="translate-x-0"
		x-transition:leave-end="-translate-x-full"
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

<aside
	{{ $attributes->merge(['data-slot' => 'sidebar-root']) }}
	class="text-foreground group peer relative hidden h-svh shrink-0 transition-[width] duration-300 ease-linear md:block"
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
			class="w-(--sidebar-width) group-data-[state=collapsed]:w-(--sidebar-width-icon) fixed inset-y-0 left-0 z-10 hidden h-svh overflow-hidden transition-[width] duration-300 ease-linear md:flex"
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

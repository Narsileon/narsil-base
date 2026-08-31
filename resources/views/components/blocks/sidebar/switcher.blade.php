@props(['items' => []])

<x-narsil::ui.dropdown-menu.root>
	<x-narsil::ui.dropdown-menu.trigger
		class="inline-flex h-9 w-full items-center justify-start gap-2 truncate px-2 py-2"
	>
		<span
			aria-hidden="true"
			class="inline-flex size-5 shrink-0 items-center justify-center"
		>
			<svg
				class="size-5"
				fill="currentColor"
				viewBox="0 0 384 512"
			>
				<path
					d="M21 34c13-5 27-1 36 9l263 317V64a32 32 0 1 1 64 0v384a32 32 0 0 1-57 21L64 152v296a32 32 0 1 1-64 0V64c0-13 8-25 21-30"
				/>
			</svg>
		</span>
		<span
			class="truncate group-data-[state=collapsed]:hidden"
		>
			{{ collect($items)->firstWhere('route', request()->route()?->getName())['label'] ?? data_get($items, '0.label', 'Home') }}
		</span>
	</x-narsil::ui.dropdown-menu.trigger>
	<x-narsil::ui.dropdown-menu.positioner>
		<x-narsil::ui.dropdown-menu.popup>
			@foreach ($items as $item)
				<x-narsil::ui.dropdown-menu.item
					:href="route($item['route'], $item['parameters'] ?? [])"
				>
					<span
						aria-hidden="true"
						class="inline-flex size-5 shrink-0 items-center justify-center"
					>
						<svg
							class="size-5"
							fill="currentColor"
							viewBox="0 0 384 512"
						>
							<path
								d="M21 34c13-5 27-1 36 9l263 317V64a32 32 0 1 1 64 0v384a32 32 0 0 1-57 21L64 152v296a32 32 0 1 1-64 0V64c0-13 8-25 21-30"
							/>
						</svg>
					</span>
					{{ $item['label'] }}
				</x-narsil::ui.dropdown-menu.item>
			@endforeach
		</x-narsil::ui.dropdown-menu.popup>
	</x-narsil::ui.dropdown-menu.positioner>
</x-narsil::ui.dropdown-menu.root>

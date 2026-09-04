@props(['items' => []])

<x-narsil::ui.dropdown-menu.root>
	<x-narsil::ui.dropdown-menu.trigger
		class="inline-flex h-9 w-full items-center justify-start gap-2 truncate px-2 py-2"
	>
		<span
			aria-hidden="true"
			class="inline-flex size-5 shrink-0 items-center justify-center"
		>
			<x-narsil::ui.icon.root
				class="size-5"
				name="fa-solid-n"
			/>
		</span>
		<span
			class="truncate opacity-100 transition-opacity duration-300 ease-linear group-data-[state=collapsed]:-z-10 group-data-[state=collapsed]:opacity-0"
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
						<x-narsil::ui.icon.root
							class="size-5"
							name="fa-solid-n"
						/>
					</span>
					{{ $item['label'] }}
				</x-narsil::ui.dropdown-menu.item>
			@endforeach
		</x-narsil::ui.dropdown-menu.popup>
	</x-narsil::ui.dropdown-menu.positioner>
</x-narsil::ui.dropdown-menu.root>

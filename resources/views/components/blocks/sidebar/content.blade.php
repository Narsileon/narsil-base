@props(['sidebar' => []])

<nav
	{{ $attributes->twMerge('flex min-h-0 flex-1 flex-col gap-2 overflow-x-hidden overflow-y-auto p-2')->merge(['data-slot' => 'sidebar-content', 'aria-label' => 'Main Menu']) }}
>
	<x-narsil::blocks.sidebar.menu>
		@foreach (collect($sidebar)->groupBy(fn($item) => $item['group'] ?? '_' . $item['label']) as $group => $items)
			@if (str_starts_with($group, '_'))
				<x-narsil::blocks.sidebar.menu-item>
					<x-narsil::blocks.sidebar.link
						:item="$items->first()"
					/>
				</x-narsil::blocks.sidebar.menu-item>
			@else
				<x-narsil::blocks.sidebar.group>
					<x-narsil::blocks.sidebar.group-label>
						{{ $group }}
					</x-narsil::blocks.sidebar.group-label>
					<x-narsil::blocks.sidebar.group-content>
						@foreach ($items as $item)
							<x-narsil::blocks.sidebar.menu-item>
								<x-narsil::blocks.sidebar.link
									:item="$item"
								/>
							</x-narsil::blocks.sidebar.menu-item>
						@endforeach
					</x-narsil::blocks.sidebar.group-content>
				</x-narsil::blocks.sidebar.group>
			@endif
		@endforeach
	</x-narsil::blocks.sidebar.menu>
</nav>

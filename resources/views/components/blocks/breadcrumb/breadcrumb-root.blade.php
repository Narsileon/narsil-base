<x-narsil::ui.breadcrumb.breadcrumb-root
	{{ $attributes }}
>
	<x-narsil::ui.breadcrumb.breadcrumb-list>
		@foreach ($breadcrumb as $index => $item)
			@if ($index > 0)
				<x-narsil::ui.breadcrumb.breadcrumb-separator>
					<x-narsil::ui.icon.icon-root
						name="chevron-right"
					/>
				</x-narsil::ui.breadcrumb.breadcrumb-separator>
			@endif
			<x-narsil::ui.breadcrumb.breadcrumb-item>
				@if ($index === count($breadcrumb) - 1)
					<x-narsil::ui.breadcrumb.breadcrumb-page>
						{{ $item['label'] ?? '' }}
					</x-narsil::ui.breadcrumb.breadcrumb-page>
				@elseif (!empty($item['href']))
					<x-narsil::ui.breadcrumb.breadcrumb-link
						href="{{ $item['href'] }}"
						wire:navigate
					>
						{{ $item['label'] ?? '' }}
					</x-narsil::ui.breadcrumb.breadcrumb-link>
				@else
					{{ $item['label'] ?? '' }}
				@endif
			</x-narsil::ui.breadcrumb.breadcrumb-item>
		@endforeach
	</x-narsil::ui.breadcrumb.breadcrumb-list>
</x-narsil::ui.breadcrumb.breadcrumb-root>

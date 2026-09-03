@props(['breadcrumb' => []])

<x-narsil::ui.breadcrumb.root
	{{ $attributes }}
>
	<x-narsil::ui.breadcrumb.list>
		@foreach ($breadcrumb as $index => $item)
			@if ($index > 0)
				<x-narsil::ui.breadcrumb.separator>
					<x-narsil::ui.icon.root
						name="chevron-right"
					/>
				</x-narsil::ui.breadcrumb.separator>
			@endif
			<x-narsil::ui.breadcrumb.item>
				@if ($index === count($breadcrumb) - 1)
					<x-narsil::ui.breadcrumb.page>
						{{ $item['label'] ?? '' }}
					</x-narsil::ui.breadcrumb.page>
				@elseif (!empty($item['href']))
					<x-narsil::ui.breadcrumb.link
						href="{{ $item['href'] }}"
					>
						{{ $item['label'] ?? '' }}
					</x-narsil::ui.breadcrumb.link>
				@else
					{{ $item['label'] ?? '' }}
				@endif
			</x-narsil::ui.breadcrumb.item>
		@endforeach
	</x-narsil::ui.breadcrumb.list>
</x-narsil::ui.breadcrumb.root>

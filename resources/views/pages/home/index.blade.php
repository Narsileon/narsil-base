@extends('narsil::layouts.auth')

@section('body')
	<main
		class="flex min-h-full w-full items-center justify-center"
	>
		<div
			class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
		>
			@foreach ($items as $item)
				<x-narsil::ui.card.card-root
					class="aspect-square h-48 w-48 cursor-pointer shadow-lg"
				>
					<a
						class="flex h-full w-full flex-col items-center justify-center gap-3 text-center transition-colors hover:bg-accent hover:text-accent-foreground"
						href="{{ route($item['route'], $item['parameters'] ?? []) }}"
						@if (($item['target'] ?? null) === '_blank') target="_blank" @endif
						@if (($item['target'] ?? null) !== '_blank') wire:navigate @endif
					>
						@if (!empty($item['icon']))
							<x-narsil::ui.icon.icon-root
								:name="$item['icon']"
							/>
						@endif
						<x-narsil::ui.heading.heading-root
							level="h2"
							variant="h5"
						>
							{{ $item['label'] }}
						</x-narsil::ui.heading.heading-root>
					</a>
				</x-narsil::ui.card.card-root>
			@endforeach
		</div>
	</main>
@endsection

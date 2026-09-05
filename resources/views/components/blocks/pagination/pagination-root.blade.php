<x-narsil::ui.pagination.pagination-root
	{{ $attributes }}
>
	<x-narsil::ui.pagination.pagination-content>
		<x-narsil::ui.pagination.pagination-item>
			<x-narsil::ui.pagination.pagination-link
				:disabled="!($links['prev'] ?? null)"
				:href="$links['first'] ?? null"
				aria-label="{{ trans('narsil::pagination.first_page') }}"
				class="rounded-r-none"
			>
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="fa-solid-angles-left"
				/>
			</x-narsil::ui.pagination.pagination-link>
		</x-narsil::ui.pagination.pagination-item>
		<x-narsil::ui.pagination.pagination-item>
			<x-narsil::ui.pagination.pagination-link
				:disabled="!($links['prev'] ?? null)"
				:href="$links['prev'] ?? null"
				aria-label="{{ trans('narsil::pagination.previous_page') }}"
				class="rounded-none"
			>
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="chevron-left"
				/>
			</x-narsil::ui.pagination.pagination-link>
		</x-narsil::ui.pagination.pagination-item>
		@foreach (array_slice($metaLinks, 1, -1) as $index => $link)
			<x-narsil::ui.pagination.pagination-item
				class="hidden sm:block"
			>
				@if ($link['url'] ?? null)
					<x-narsil::ui.pagination.pagination-link
						:active="$link['active'] ?? false"
						:href="$link['url']"
						class="rounded-none"
					>
						{{ $link['label'] }}
					</x-narsil::ui.pagination.pagination-link>
				@else
					<x-narsil::ui.pagination.pagination-link
						class="rounded-none"
						disabled
					>
						<x-narsil::ui.pagination.pagination-ellipsis />
					</x-narsil::ui.pagination.pagination-link>
				@endif
			</x-narsil::ui.pagination.pagination-item>
		@endforeach
		<x-narsil::ui.pagination.pagination-item>
			<x-narsil::ui.pagination.pagination-link
				:disabled="!($links['next'] ?? null)"
				:href="$links['next'] ?? null"
				aria-label="{{ trans('narsil::pagination.next_page') }}"
				class="rounded-none"
			>
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="chevron-right"
				/>
			</x-narsil::ui.pagination.pagination-link>
		</x-narsil::ui.pagination.pagination-item>
		<x-narsil::ui.pagination.pagination-item>
			<x-narsil::ui.pagination.pagination-link
				:disabled="!($links['next'] ?? null)"
				:href="$links['last'] ?? null"
				aria-label="{{ trans('narsil::pagination.last_page') }}"
				class="rounded-l-none"
			>
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="fa-solid-angles-right"
				/>
			</x-narsil::ui.pagination.pagination-link>
		</x-narsil::ui.pagination.pagination-item>
	</x-narsil::ui.pagination.pagination-content>
</x-narsil::ui.pagination.pagination-root>

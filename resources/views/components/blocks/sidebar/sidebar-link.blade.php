@php
	$url = route($item['route'], $item['parameters'] ?? []);
	$active = str_ends_with($url, request()->getPathInfo());
@endphp

<a
	{{ $attributes->twMerge('flex h-8 w-full items-center gap-2 overflow-hidden rounded-md px-2 text-sm outline-hidden transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:font-medium data-[active=true]:text-accent-foreground')->merge(['data-slot' => 'sidebar-link', 'data-active' => $active ? 'true' : 'false', 'href' => $url]) }}
	@if (($item['target'] ?? null) === '_blank') target="_blank" @endif
>
	@if (!empty($item['icon']))
		<x-narsil::ui.icon.icon-root
			:name="$item['icon']"
			class="text-primary shrink-0"
		/>
	@endif
	<span
		class="truncate opacity-100 transition-opacity duration-300 ease-linear group-data-[state=collapsed]:-z-10 group-data-[state=collapsed]:opacity-0"
	>
		{{ $item['label'] }}
	</span>
</a>

@props(['item'])

@php
	$url = route($item['route'], $item['parameters'] ?? []);
	$active = str_ends_with($url, request()->getPathInfo());
@endphp

<a
	{{ $attributes->twMerge('flex h-8 w-full items-center gap-2 overflow-hidden rounded-md px-2 text-sm outline-hidden transition-colors hover:bg-sidebar-accent hover:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground group-data-[state=collapsed]:justify-center')->merge(['data-slot' => 'sidebar-link', 'data-active' => $active ? 'true' : 'false', 'href' => $url]) }}
	@if (($item['target'] ?? null) === '_blank') target="_blank" @endif
>
	@if (!empty($item['icon']))
		<x-narsil::ui.icon.root
			:name="$item['icon']"
			class="text-primary shrink-0"
		/>
	@endif
	<span
		class="truncate group-data-[state=collapsed]:hidden"
	>
		{{ $item['label'] }}
	</span>
</a>

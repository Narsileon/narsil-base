<footer
	{{ $attributes->twMerge('flex h-13 flex-col justify-center gap-2 border-t p-2')->merge([
	    'data-slot' => 'sidebar-footer',
	]) }}
>
	<button
		class="hover:bg-accent hover:text-accent-foreground inline-flex h-8 w-full cursor-pointer items-center justify-start gap-2 rounded-md px-2 text-sm transition-colors"
		type="button"
		x-on:click="toggleSidebar()"
	>
		<x-narsil::ui.icon.icon-root
			class="size-4 transition-transform duration-300 group-data-[state=collapsed]:rotate-180"
			name="chevron-left"
		/>
		<span
			class="truncate opacity-100 transition-opacity duration-300 ease-linear group-data-[state=collapsed]:-z-10 group-data-[state=collapsed]:opacity-0"
		>
			{{ trans('narsil::accessibility.close_sidebar') }}
		</span>
	</button>
</footer>

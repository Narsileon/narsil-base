
<x-narsil::ui.card.card-header
	class="flex items-center justify-between border-b"
>
	<x-narsil::ui.card.card-title
		class="flex h-9 items-center"
	>
		{{ $title }}
	</x-narsil::ui.card.card-title>
	<template
		x-if="currentBookmark() === undefined"
	>
		<form
			action="{{ $storeUrl }}"
			class="flex items-center"
			method="POST"
		>
			@csrf
			<input
				name="name"
				type="hidden"
				value="{{ collect($breadcrumb)->pluck('label')->join(' > ') }}"
			>
			<input
				name="url"
				type="hidden"
				value="{{ $currentUrl }}"
			>
			<x-narsil::ui.button.button-root
				aria-label="{{ trans('narsil::ui.add') }}"
				class="-my-2"
				size="icon-sm"
				type="submit"
				variant="ghost"
			>
				<x-narsil::ui.icon.icon-root
					name="star-outline"
				/>
			</x-narsil::ui.button.button-root>
		</form>
	</template>
	<template
		x-if="currentBookmark() !== undefined"
	>
		<form
			class="flex items-center"
			method="POST"
			x-bind:action="`{{ $destroyUrl }}`.replace('__bookmark__', currentBookmark().uuid)"
		>
			@csrf
			@method('DELETE')
			<x-narsil::ui.button.button-root
				aria-label="{{ trans('narsil::ui.delete') }}"
				class="-my-2"
				size="icon-sm"
				type="submit"
				variant="ghost"
			>
				<x-narsil::ui.icon.icon-root
					name="star"
				/>
			</x-narsil::ui.button.button-root>
		</form>
	</template>
</x-narsil::ui.card.card-header>
<x-narsil::ui.card.card-content>
	<ul
		class="-my-2 flex flex-col gap-1"
		x-show="!loading && bookmarks.length > 0"
	>
		<template
			:key="bookmark.uuid"
			x-for="bookmark in bookmarks"
		>
			<li
				class="flex items-center justify-between gap-2"
			>
				<a
					class="text-foreground hover:text-primary min-w-0 truncate"
					x-bind:href="bookmark.url"
					x-on:click="open = false"
					x-text="bookmark.name"
				></a>
				<div
					class="flex shrink-0 items-center gap-1"
				>
					<x-narsil::ui.button.button-root
						aria-label="{{ trans('narsil::ui.edit') }}"
						size="icon-sm"
						variant="ghost"
						x-on:click="editing = bookmark"
					>
						<x-narsil::ui.icon.icon-root
							name="edit"
						/>
					</x-narsil::ui.button.button-root>
					<form
						method="POST"
						x-bind:action="`{{ $destroyUrl }}`.replace('__bookmark__', bookmark.uuid)"
					>
						@csrf
						@method('DELETE')
						<x-narsil::ui.button.button-root
							aria-label="{{ trans('narsil::ui.delete') }}"
							size="icon-sm"
							type="submit"
							variant="ghost"
						>
							<x-narsil::ui.icon.icon-root
								name="star-off"
							/>
						</x-narsil::ui.button.button-root>
					</form>
				</div>
			</li>
		</template>
	</ul>
	<p
		class="text-muted-foreground"
		x-show="!loading && bookmarks.length === 0"
	>
		{{ trans('narsil::bookmarks.empty') }}
	</p>
</x-narsil::ui.card.card-content>

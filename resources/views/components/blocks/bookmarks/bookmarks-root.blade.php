<div
	{{ $attributes->twMerge('relative') }}
	x-data="{
    bookmarksOpen: false,
    loading: false,
    editing: null,
    bookmarks: [],
    async loadBookmarks() {
        if (this.bookmarks.length > 0 || this.loading) {
            return;
        }

        this.loading = true;

        try {
            const response = await fetch(@js($indexUrl), { headers: { Accept: 'application/json' } });
            const data = await response.json();

            this.bookmarks = (data.data ?? []).sort((first, second) => first.name.localeCompare(second.name));
        } finally {
            this.loading = false;
        }
    },
    toggle() {
        this.bookmarksOpen = !this.bookmarksOpen;

        if (this.bookmarksOpen) {
            this.loadBookmarks();
        }
    },
    currentBookmark() {
        return this.bookmarks.find((bookmark) => bookmark.url === @js($currentUrl));
    }
}"
	x-on:click.outside="bookmarksOpen = false; editing = null"
	x-on:keydown.escape.window="bookmarksOpen = false"
>
	<x-narsil::ui.button.button-root
		aria-label="{{ $title }}"
		class="text-foreground"
		size="icon"
		variant="ghost"
		x-on:click="toggle()"
	>
		<x-narsil::ui.icon.icon-root
			name="star"
		/>
	</x-narsil::ui.button.button-root>
	<div
		class="absolute right-0 top-full z-50 mt-2"
		x-cloak
		x-show="bookmarksOpen"
		x-transition.origin.top.right
	>
		<x-narsil::ui.card.card-root
			class="w-80"
		>
			<div
				x-show="editing === null"
			>
				<x-narsil::blocks.bookmarks.bookmarks-list
					:breadcrumb="$breadcrumb"
					:current-url="$currentUrl"
					:destroy-url="$destroyUrl"
					:store-url="$storeUrl"
					:title="$title"
				/>
			</div>
			<div
				x-cloak
				x-show="editing !== null"
			>
				<x-narsil::blocks.bookmarks.bookmarks-form
					:update-url="$updateUrl"
				/>
			</div>
		</x-narsil::ui.card.card-root>
	</div>
</div>

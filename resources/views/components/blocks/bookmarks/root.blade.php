<div
	{{ $attributes->twMerge('relative') }}
	x-data="{
    open: false,
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
        this.open = !this.open;

        if (this.open) {
            this.loadBookmarks();
        }
    },
    currentBookmark() {
        return this.bookmarks.find((bookmark) => bookmark.url === @js($currentUrl));
    }
}"
	x-on:click.outside="open = false; editing = null"
	x-on:keydown.escape.window="open = false"
>
	<x-narsil::ui.button.root
		aria-label="{{ $title }}"
		class="text-foreground"
		size="icon"
		variant="ghost"
		x-on:click="toggle()"
	>
		<x-narsil::ui.icon.root
			name="star"
		/>
	</x-narsil::ui.button.root>
	<div
		class="absolute right-0 top-full z-50 mt-2"
		x-cloak
		x-show="open"
		x-transition.origin.top.right
	>
		<x-narsil::ui.card.root
			class="w-80"
		>
			<div
				x-show="editing === null"
			>
				<x-narsil::blocks.bookmarks.list
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
				<x-narsil::blocks.bookmarks.form
					:update-url="$updateUrl"
				/>
			</div>
		</x-narsil::ui.card.root>
	</div>
</div>

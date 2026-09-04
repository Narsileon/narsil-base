<div
	{{ $attributes->merge(['data-slot' => 'sidebar-provider']) }}
	class="group/sidebar-wrapper flex min-h-svh w-full"
	style="--sidebar-width: 14rem; --sidebar-width-icon: 3.25rem;"
	x-data="{
    open: JSON.parse(document.cookie.match(/(?:^|; )sidebar_state=([^;]*)/)?.[1] ?? 'true'),
    toggleSidebar() {
        this.open = !this.open;
        document.cookie = `sidebar_state=${this.open}; path=/; max-age=604800`;
    },
    openSidebar() {
        this.open = true;
        document.cookie = 'sidebar_state=true; path=/; max-age=604800';
    }
}"
>
	{{ $slot }}
</div>

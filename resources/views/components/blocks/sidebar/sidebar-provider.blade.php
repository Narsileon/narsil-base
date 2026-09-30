<div
	{{ $attributes->twMerge('group/sidebar-wrapper flex min-h-svh w-full')->merge([
	    'data-slot' => 'sidebar-provider',
	]) }}
	style="--sidebar-width: 14rem; --sidebar-width-icon: 3.25rem;"
	x-data="{
    sidebarOpen: @js($sidebarOpen),
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        document.cookie = `sidebar_state=${this.sidebarOpen}; path=/; max-age=604800`;
    },
    openSidebar() {
        this.sidebarOpen = true;
        document.cookie = 'sidebar_state=true; path=/; max-age=604800';
    }
}"
>
	{{ $slot }}
</div>

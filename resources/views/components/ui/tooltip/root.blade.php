<div
	{{ $attributes->twMerge('relative inline-flex') }}
	data-slot="tooltip-root"
	x-data="{ open: false, timer: null, show() { clearTimeout(this.timer); this.timer = setTimeout(() => this.open = true, 0) }, hide() { clearTimeout(this.timer); this.open = false } }"
	x-on:focusin="show()"
	x-on:focusout="hide()"
	x-on:mouseenter="show()"
	x-on:mouseleave="hide()"
>
	{{ $slot }}
</div>

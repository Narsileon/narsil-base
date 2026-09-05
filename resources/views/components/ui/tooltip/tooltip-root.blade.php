<div
	{{ $attributes->twMerge('relative inline-flex') }}
	data-slot="tooltip-root"
	x-data="{
    tooltipOpen: false,
    timer: null,
    show() {
        clearTimeout(this.timer);
        const delay = Math.max(0, Number(this.$el.closest('[data-slot=tooltip-provider]')?.dataset.delay ?? 0));
        this.timer = setTimeout(() => {
            this.tooltipOpen = true;
            this.$nextTick(() => requestAnimationFrame(() => this.positionArrow()));
        }, delay)
    },
    hide() {
        clearTimeout(this.timer);
        this.tooltipOpen = false
    },
    positionArrow() {
        if (!this.tooltipOpen || !this.$refs['tooltip-arrow']) {
            return;
        }

        const arrow = this.$refs['tooltip-arrow'];
        const popup = arrow.parentElement;
        const trigger = this.$refs['tooltip-trigger'];
        const triggerRect = trigger.getBoundingClientRect();
        const popupRect = popup.getBoundingClientRect();
        const arrowSize = arrow.offsetWidth;
        const triggerCenter = triggerRect.left + (triggerRect.width / 2) - popupRect.left;
        const minimum = (arrowSize / 2) + 4;
        const maximum = popupRect.width - minimum;
        const position = Math.max(minimum, Math.min(maximum, triggerCenter));

        arrow.style.left = `${position}px`;
    }
}"
	x-on:focusin="show()"
	x-on:focusout="hide()"
	x-on:mouseenter="show()"
	x-on:mouseleave="hide()"
	x-on:resize.window="positionArrow()"
	x-on:scroll.window="positionArrow()"
>
	{{ $slot }}
</div>

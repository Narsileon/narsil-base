<div
	{{ $attributes->twMerge('flex flex-col gap-1')->merge([
	    'data-slot' => 'sortable-list',
	]) }}
	x-data="{
    order: [],
    init() {
        this.sync();
    },
    sync() {
        this.order = Array.from(this.$el.children)
            .filter((item) => item.hasAttribute('data-sortable-item'))
            .map((item) => item.dataset.sortableItem);
        this.updateButtons();
        this.$dispatch('sortable-list-change', { order: this.order });
    },
    updateButtons() {
        this.$el.querySelectorAll('[data-sortable-up]').forEach((button) => {
            button.disabled = this.order.indexOf(button.dataset.sortableUp) === 0;
        });
        this.$el.querySelectorAll('[data-sortable-down]').forEach((button) => {
            button.disabled = this.order.indexOf(button.dataset.sortableDown) === this.order.length - 1;
        });
    },
    move(id, direction) {
        const items = Array.from(this.$el.children)
            .filter((item) => item.hasAttribute('data-sortable-item'));
        const index = items.findIndex((item) => item.dataset.sortableItem === id);
        const next = index + direction;

        if (index < 0 || next < 0 || next >= items.length) {
            return;
        }

        if (direction < 0) {
            items[next].before(items[index]);
        } else {
            items[next].after(items[index]);
        }

        this.sync();
    }
}"
	x-on:sortable-list-move.window="move($event.detail.id, $event.detail.direction)"
	x-sort="sync()"
>
	{{ $slot }}
</div>

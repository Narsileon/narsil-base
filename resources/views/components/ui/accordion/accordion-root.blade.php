
<div
	{{ $attributes->twMerge('flex w-full flex-col')->merge([
	    'data-slot' => 'accordion-root',
	]) }}
	x-data="{
    active: @js($multiple ? [] : $defaultValue),
    multiple: @js($multiple),
    isOpen(value) {
        return this.multiple ? this.active.includes(value) : this.active === value;
    },
    toggle(value) {
        if (this.multiple) {
            this.active = this.active.includes(value) ?
                this.active.filter((activeValue) => activeValue !== value) : [...this.active, value];

            return;
        }

        this.active = this.active === value ? null : value;
    }
}"
>
	{{ $slot }}
</div>


<x-narsil::ui.input-group.input-group-root
	class="h-fit min-h-9 cursor-pointer focus-within:border-primary focus-within:ring-primary"
	x-data="{
        fileName: '',
        preview: null,
        setFile(file) {
            if (!file) return;

            this.fileName = file.name;
            this.preview = file.type.startsWith('image/') ? URL.createObjectURL(file) : null;
        },
        clearFile() {
            this.fileName = '';
            this.preview = null;
            $refs.input.value = '';
        }
    }"
	x-on:click="if (!$event.target.closest('button')) $refs.input.click()"
	x-on:dragover.prevent
	x-on:drop.prevent="setFile($event.dataTransfer.files[0]); $refs.input.files = $event.dataTransfer.files"
	x-on:keydown.enter.prevent="$refs.input.click()"
	tabindex="0"
>
	<x-narsil::ui.file.file-upload :icon="$element->icon ?? 'upload'" />
	<div
		class="flex w-full items-center gap-2 p-2"
		x-cloak
		x-show="fileName"
	>
		<template x-if="preview">
			<img
				class="size-36 rounded-md object-cover"
				x-bind:src="preview"
				alt=""
			/>
		</template>
		<x-narsil::ui.input-group.input-group-text
			class="min-w-0 grow justify-start"
			x-text="fileName"
		/>
		<x-narsil::ui.input-group.input-group-button
			aria-label="{{ trans('narsil::ui.close') }}"
			x-on:click.stop="clearFile()"
		>
			<x-narsil::ui.icon.icon-root name="x" />
		</x-narsil::ui.input-group.input-group-button>
	</div>
	<x-narsil::ui.input.input-root
		:accept="$input->accept ?? '*/*'"
		:disabled="$element->readOnly ?? false"
		:name="$id"
		:required="$element->required ?? false"
		class="hidden"
		x-ref="input"
		x-on:change="setFile($event.target.files[0])"
		id="{{ $id }}"
		type="file"
	/>
</x-narsil::ui.input-group.input-group-root>

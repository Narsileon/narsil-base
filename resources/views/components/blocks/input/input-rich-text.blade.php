<div
	{{ $attributes->twMerge('border-color flex flex-col rounded-md border')->merge([
	    'data-slot' => 'rich-text-editor-root',
	]) }}
	data-rich-text-editor
	x-data="narsilRichTextEditor({
    id: @js((string) $id),
    placeholder: @js($placeholder),
    readOnly: @js($readOnly),
    required: @js($required),
    value: @js($value),
})"
	@if ($translatable)
		x-on:rich-text-change="translationValues[fieldLanguage] = $event.detail.value"
		x-effect="setValue(translationValues[fieldLanguage] ?? '')"
	@endif
>
	@if (!$readOnly && $toolbarGroups)
		<div
			data-rich-text-toolbar
			class="border-color no-scrollbar flex h-11 items-center gap-1 overflow-x-auto border-b px-1"
			x-cloak
		>
			@foreach ($toolbarGroups as $groupIndex => $group)
				@if ($groupIndex > 0)
					<x-narsil::ui.separator.separator-root
						class="mx-1 h-5"
						orientation="vertical"
					/>
				@endif
				@if ($group['type'] === 'headings')
					<x-narsil::ui.dropdown-menu.dropdown-menu-root>
						<x-narsil::blocks.tooltip.tooltip-root
							:tooltip="trans('narsil::rich-text-editor.headings')"
						>
							<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
								aria-label="{{ trans('narsil::rich-text-editor.headings') }}"
								class="rounded-md"
								size="icon"
								variant="ghost"
							>
								<x-narsil::ui.icon.icon-root
									name="fa-solid-heading"
								/>
							</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
						</x-narsil::blocks.tooltip.tooltip-root>
						<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
							<x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
								<x-narsil::ui.dropdown-menu.dropdown-menu-popup
									class="min-w-9"
								>
									@foreach ($group['levels'] as $level)
										<x-narsil::blocks.tooltip.tooltip-root
											:tooltip="trans('narsil::rich-text-editor.heading_' . $level)"
										>
											<x-narsil::ui.button.button-root
												aria-label="{{ trans('narsil::rich-text-editor.heading_' . $level) }}"
												class="rounded-md aria-pressed:bg-muted"
												size="icon"
												variant="ghost"
												x-bind:aria-pressed="isActive('heading', { level: {{ $level }} })"
												x-bind:data-state="isActive('heading', { level: {{ $level }} }) ? 'on' : 'off'"
									x-on:mousedown.prevent="$event.preventDefault()"
												x-on:click="toggleHeading({{ $level }}); dropdownOpen = false"
											>
												<span class="text-xs font-semibold">H{{ $level }}</span>
											</x-narsil::ui.button.button-root>
										</x-narsil::blocks.tooltip.tooltip-root>
									@endforeach
								</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
							</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
						</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
					</x-narsil::ui.dropdown-menu.dropdown-menu-root>
				@else
					@foreach ($group['controls'] as $control)
						<x-narsil::blocks.tooltip.tooltip-root
							:tooltip="$control['label']"
						>
							<x-narsil::ui.button.button-root
								aria-label="{{ $control['label'] }}"
								class="rounded-md aria-pressed:bg-muted"
								size="icon"
								variant="ghost"
								x-bind:aria-pressed="{{ $control['activeExpression'] }}"
								x-bind:data-state="{{ $control['stateExpression'] }}"
								x-bind:disabled="{{ $control['disabledExpression'] }}"
								x-on:click="{{ $control['handler'] }}"
								x-on:mousedown.prevent="$event.preventDefault()"
							>
								<x-narsil::ui.icon.icon-root
									:name="$control['icon']"
								/>
							</x-narsil::ui.button.button-root>
						</x-narsil::blocks.tooltip.tooltip-root>
					@endforeach
				@endif
			@endforeach
		</div>
	@endif
	@if (!$translatable)
		<input
			name="{{ $name }}"
			type="hidden"
			x-model="value"
		>
	@endif
	<div
		data-rich-text-content
		data-slot="rich-text-editor-content"
	></div>
</div>

<div
	class="flex w-fit items-stretch"
	x-data="{
    submit(name, value) {
            const form = document.getElementById({{ Illuminate\Support\Js::from($formId) }});

            if (!form) {
                return;
            }

            const input = document.createElement('input');
            input.name = name;
            input.type = 'hidden';
            input.value = value;
            form.appendChild(input);
            form.requestSubmit();
        },
        saveAsNew() {
            const form = document.getElementById({{ Illuminate\Support\Js::from($formId) }});

            if (!form) {
                return;
            }

            form.action = {{ Illuminate\Support\Js::from($saveAsNewUrl) }};
            form.method = 'post';
            form.querySelector('input[name=_method]')?.remove();
            form.submit();
        }
}"
	x-on:keydown.window="
    if (!($event.ctrlKey || $event.metaKey)) return;
    if ($event.code === 'KeyD' && {{ $saveAsNewUrl ? 'true' : 'false' }}) {
        $event.preventDefault();
        saveAsNew();
    }
    if ($event.code === 'KeyP' && {{ $publish ? 'true' : 'false' }}) {
        $event.preventDefault();
        submit('published', '1');
    }
    if ($event.code === 'KeyS' && $event.shiftKey && {{ $createUrl ? 'true' : 'false' }}) {
        $event.preventDefault();
        submit('_to', {{ Illuminate\Support\Js::from($createUrl) }});
    }
    if ($event.code === 'KeyS' && !$event.shiftKey) {
        $event.preventDefault();
        submit('_back', '1');
    }
"
>
	<x-narsil::ui.button-group.button-group-root>
		<x-narsil::ui.button.button-root
			:form="$formId"
			type="submit"
		>
			{{ $submitLabel }}
		</x-narsil::ui.button.button-root>
		<x-narsil::ui.separator.separator-root
			orientation="vertical"
		/>
		<x-narsil::ui.dropdown-menu.dropdown-menu-root
			class="contents"
		>
			<x-narsil::ui.dropdown-menu.dropdown-menu-trigger
				aria-label="{{ trans('narsil::ui.menu') }}"
				class="w-8"
				size="icon"
				variant="primary"
			>
				<x-narsil::ui.icon.icon-root
					class="size-4"
					name="chevron-down"
				/>
			</x-narsil::ui.dropdown-menu.dropdown-menu-trigger>
			<x-narsil::ui.dropdown-menu.dropdown-menu-portal>
				<x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
					<x-narsil::ui.dropdown-menu.dropdown-menu-popup>
						@if ($publish)
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								:form="$formId"
								name="published"
								type="submit"
								value="1"
							>
								<x-narsil::ui.icon.icon-root
									name="eye"
								/>
								{{ $submitLabel }} & {{ trans('narsil::ui.publish') }}
								<x-narsil::ui.kbd-group.kbd-group-root
									class="ml-auto"
								>
									<x-narsil::ui.kbd.kbd-root>Ctrl</x-narsil::ui.kbd.kbd-root>
									<x-narsil::ui.kbd.kbd-root>P</x-narsil::ui.kbd.kbd-root>
								</x-narsil::ui.kbd-group.kbd-group-root>
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@endif
						<x-narsil::ui.dropdown-menu.dropdown-menu-item
							:form="$formId"
							name="_back"
							type="submit"
							value="1"
						>
							<x-narsil::ui.icon.icon-root
								name="save"
							/>
							{{ $submitLabel }} & {{ trans('narsil::ui.continue') }}
							<x-narsil::ui.kbd-group.kbd-group-root
								class="ml-auto"
							>
								<x-narsil::ui.kbd.kbd-root>Ctrl</x-narsil::ui.kbd.kbd-root>
								<x-narsil::ui.kbd.kbd-root>S</x-narsil::ui.kbd.kbd-root>
							</x-narsil::ui.kbd-group.kbd-group-root>
						</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@if ($createUrl)
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								:form="$formId"
								:value="$createUrl"
								name="_to"
								type="submit"
							>
								<x-narsil::ui.icon.icon-root
									name="plus"
								/>
								{{ $submitLabel }} & {{ trans('narsil::ui.create_another') }}
								<x-narsil::ui.kbd-group.kbd-group-root
									class="ml-auto"
								>
									<x-narsil::ui.kbd.kbd-root>Ctrl</x-narsil::ui.kbd.kbd-root>
									<x-narsil::ui.kbd.kbd-root>Shift</x-narsil::ui.kbd.kbd-root>
									<x-narsil::ui.kbd.kbd-root>S</x-narsil::ui.kbd.kbd-root>
								</x-narsil::ui.kbd-group.kbd-group-root>
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@endif
						@if ($saveAsNewUrl)
							<x-narsil::ui.dropdown-menu.dropdown-menu-separator />
							<x-narsil::ui.dropdown-menu.dropdown-menu-item
								x-on:click="saveAsNew()"
							>
								<x-narsil::ui.icon.icon-root
									name="plus"
								/>
								{{ trans('narsil::ui.save_as_new') }}
								<x-narsil::ui.kbd-group.kbd-group-root
									class="ml-auto"
								>
									<x-narsil::ui.kbd.kbd-root>Ctrl</x-narsil::ui.kbd.kbd-root>
									<x-narsil::ui.kbd.kbd-root>D</x-narsil::ui.kbd.kbd-root>
								</x-narsil::ui.kbd-group.kbd-group-root>
							</x-narsil::ui.dropdown-menu.dropdown-menu-item>
						@endif
					</x-narsil::ui.dropdown-menu.dropdown-menu-popup>
				</x-narsil::ui.dropdown-menu.dropdown-menu-positioner>
			</x-narsil::ui.dropdown-menu.dropdown-menu-portal>
		</x-narsil::ui.dropdown-menu.dropdown-menu-root>
	</x-narsil::ui.button-group.button-group-root>
</div>

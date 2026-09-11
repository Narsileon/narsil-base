<x-narsil::ui.form.form-provider
	:default-language="$form->defaultLanguage ?? app()->getLocale()"
	:languages="$form->languages ?? []"
	class="flex min-h-0 flex-col"
>
	<x-narsil::ui.form.form-root
		:action="$form->action"
		:enctype="$form->enctype ?? 'application/x-www-form-urlencoded'"
		:method="$form->method ?? 'POST'"
		class="flex min-h-0 flex-col"
		data-form-source="{{ request()->fullUrl() }}"
	>
		<x-narsil::ui.form.form-tabs
			:form-data="$data"
			:languages="$form->languages ?? []"
			:steps="$form->steps"
		/>
		<x-narsil::ui.dialog.dialog-footer
			class="shrink-0 border-t"
		>
			<x-narsil::ui.dialog.dialog-close
				variant="ghost"
			>{{ trans('narsil::ui.cancel') }}</x-narsil::ui.dialog.dialog-close>
			<x-narsil::ui.button.button-root
				type="submit"
			>{{ trans('narsil::ui.save') }}</x-narsil::ui.button.button-root>
		</x-narsil::ui.dialog.dialog-footer>
	</x-narsil::ui.form.form-root>
</x-narsil::ui.form.form-provider>

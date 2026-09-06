<main
	class="h-full min-h-0 overflow-hidden"
>
	<x-narsil::ui.form.form-provider
		class="flex h-full min-h-0 flex-col overflow-hidden"
		:default-language="$form->defaultLanguage ?? app()->getLocale()"
		:languages="$form->languages ?? []"
	>
		<x-narsil::ui.form.form-root
			:action="$form->action"
			:enctype="$form->enctype ?? 'application/x-www-form-urlencoded'"
			:id="$form->id ?? 'form'"
			:method="$form->method ?? 'POST'"
			class="relative h-full min-h-0 w-full items-center grid-cols-12 md:max-h-full md:min-h-full md:overflow-hidden"
		>
			<x-narsil::ui.section.section-root
				class="col-span-12 h-full max-h-full min-h-0 flex-3 overflow-hidden md:col-span-7 lg:col-span-8 2xl:col-span-9"
			>
				<x-narsil::ui.section.section-content
					class="flex min-h-0 flex-1 flex-col"
				>
					<x-narsil::ui.form.form-tabs
						:default-language="$form->defaultLanguage ?? app()->getLocale()"
						:form-data="$formData"
						:languages="$form->languages ?? []"
						:sidebar="$sidebar"
						:steps="$steps"
					>
						<x-narsil::ui.form.form-save
							:form-id="$form->id ?? 'form'"
							:has-model="$hasModel"
							:routes="$form->routes ?? []"
							:submit-label="$form->submitLabel ?? trans('narsil::ui.save')"
						/>
					</x-narsil::ui.form.form-tabs>
				</x-narsil::ui.section.section-content>
			</x-narsil::ui.section.section-root>
			<x-narsil::ui.section.section-root
				class="col-span-12 hidden h-full max-h-full min-h-full flex-1 overflow-y-auto border-t md:col-span-5 md:flex md:border-l md:border-t-0 lg:col-span-4 2xl:col-span-3"
			>
				<x-narsil::ui.section.section-content
					class="flex flex-col"
				>
					<div
						class="flex h-13 flex-row-reverse items-center justify-between gap-2 border-b px-4 py-2"
					>
						<div
							class="flex items-center gap-2"
						>
							<x-narsil::ui.form.form-save
								:form-id="$form->id ?? 'form'"
								:has-model="$hasModel"
								:routes="$form->routes ?? []"
								:submit-label="$form->submitLabel ?? trans('narsil::ui.save')"
							>
							</x-narsil::ui.form.form-save>
						</div>
					</div>
					@if (data_get($formData, 'created_at') || data_get($formData, 'updated_at'))
						<div
							class="grid items-start gap-4 border-b p-4"
						>
							<x-narsil::ui.form.form-blame
								:data="$formData"
							/>
						</div>
					@endif
					@if ($form->languages ?? [])
						<x-narsil::ui.form.form-language
							:default-language="$form->defaultLanguage ?? app()->getLocale()"
							:languages="$form->languages"
							:value="$form->defaultLanguage ?? app()->getLocale()"
						/>
					@endif
					@if ($sidebar)
						<div
							class="grid gap-y-4 p-4"
						>
							@foreach ($sidebar->elements ?? [] as $element)
								<x-narsil::ui.form.form-element
									:element="$element"
									:languages="$form->languages ?? []"
									:value="data_get($formData, $element->id)"
								/>
							@endforeach
						</div>
					@endif
				</x-narsil::ui.section.section-content>
			</x-narsil::ui.section.section-root>
		</x-narsil::ui.form.form-root>
	</x-narsil::ui.form.form-provider>
</main>

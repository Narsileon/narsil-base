<div
	x-data="{
    activeTab: @js(session('narsil_user_settings_tab', $authenticated ? 'account' : 'configuration')),
    applyColor(color) {
        document.documentElement.dataset.color = color;
    },
    applyRadius(radius) {
        document.documentElement.style.setProperty('--radius', `${radius}rem`);
    }
}"
	x-on:dynamic-form-input.window="if ($event.detail.id === 'radius') applyRadius($event.detail.value)"
	x-on:open-user-settings.window="$dispatch('dialog-open')"
	x-on:select-change.window="if ($event.detail.id === 'color') applyColor($event.detail.value)"
>
	<x-narsil::ui.dialog.dialog-root
		:open="session('narsil_user_settings_open', false)"
		wire:ignore.self
		x-on:open-user-settings.window="dialogOpen = true"
	>
		<x-narsil::ui.dialog.dialog-backdrop />
		<x-narsil::ui.dialog.dialog-popup
			aria-labelledby="user-settings-title"
			class="pointer-events-auto grid min-h-0 grid-rows-[auto_minmax(0,1fr)]"
			style="width: min(calc(100% - 2rem), 56rem); height: min(40rem, calc(100% - 2rem));"
		>
			<x-narsil::ui.dialog.dialog-header
				class="border-b"
			>
				<x-narsil::ui.dialog.dialog-title
					id="user-settings-title"
				>
					{{ trans('narsil::ui.settings') }}
				</x-narsil::ui.dialog.dialog-title>
			</x-narsil::ui.dialog.dialog-header>

			<x-narsil::ui.tabs.tabs-root
				class="min-h-0 flex-1 flex-col md:flex-row"
				orientation="vertical"
			>
				<x-narsil::ui.tabs.tabs-list
					class="min-w-0 flex-row overflow-x-auto overflow-y-hidden px-4 py-2 md:min-w-40 md:flex-col md:overflow-y-auto md:overflow-x-hidden md:p-4"
				>
					@if ($authenticated)
						<x-narsil::ui.tabs.tabs-tab
							class="justify-start"
							x-bind:data-active="activeTab === 'account'"
							x-on:click="activeTab = 'account'"
						>
							<x-narsil::ui.icon.icon-root
								name="user-edit"
							/>
							{{ trans('narsil::ui.account') }}
						</x-narsil::ui.tabs.tabs-tab>
					@endif
					<x-narsil::ui.tabs.tabs-tab
						class="justify-start"
						x-bind:data-active="activeTab === 'configuration'"
						x-on:click="activeTab = 'configuration'"
					>
						<x-narsil::ui.icon.icon-root
							name="settings"
						/>
						{{ trans('narsil::ui.personalization') }}
					</x-narsil::ui.tabs.tabs-tab>
					@if ($authenticated)
						<x-narsil::ui.tabs.tabs-tab
							class="justify-start"
							x-bind:data-active="activeTab === 'security'"
							x-on:click="activeTab = 'security'"
						>
							<x-narsil::ui.icon.icon-root
								name="shield"
							/>
							{{ trans('narsil::ui.security') }}
						</x-narsil::ui.tabs.tabs-tab>
					@endif
				</x-narsil::ui.tabs.tabs-list>
				<x-narsil::ui.tabs.tabs-separator
					class="hidden md:block"
					orientation="vertical"
				/>
				<x-narsil::ui.tabs.tabs-separator
					class="md:hidden"
					orientation="horizontal"
				/>

				@if ($authenticated)
					<x-narsil::ui.tabs.tabs-panel
						class="overflow-y-auto"
						x-cloak
						x-show="activeTab === 'account'"
					>
						<x-narsil::ui.section.section-root>
							<x-narsil::ui.section.section-header
								class="border-b"
							>
								<x-narsil::ui.heading.heading-root
									level="h2"
								>
									{{ trans('narsil::ui.account') }}
								</x-narsil::ui.heading.heading-root>
								<x-narsil::ui.section.section-action>
									<x-narsil::ui.button.button-root
										form="profile-form"
										type="submit"
									>
										<x-narsil::ui.icon.icon-root
											name="save"
										/>
										{{ trans('narsil::ui.save') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.section.section-action>
							</x-narsil::ui.section.section-header>
							<x-narsil::ui.section.section-content>
								<x-narsil::blocks.user-settings.user-settings-form
									:form="$this->getProfileForm()"
									:show-submit="false"
									:values="$profileValues"
								/>
							</x-narsil::ui.section.section-content>
						</x-narsil::ui.section.section-root>
						<x-narsil::ui.separator.separator-root />
						<x-narsil::ui.section.section-root>
							<x-narsil::ui.section.section-header
								class="border-b"
							>
								<x-narsil::ui.heading.heading-root
									level="h2"
								>
									{{ trans('narsil::ui.password') }}
								</x-narsil::ui.heading.heading-root>
								<x-narsil::ui.section.section-action>
									<x-narsil::ui.button.button-root
										form="update-password-form"
										type="submit"
									>
										<x-narsil::ui.icon.icon-root
											name="save"
										/>
										{{ trans('narsil::ui.save') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.section.section-action>
							</x-narsil::ui.section.section-header>
							<x-narsil::ui.section.section-content>
								<x-narsil::blocks.user-settings.user-settings-form
									:form="$this->getPasswordForm()"
									:show-submit="false"
								/>
							</x-narsil::ui.section.section-content>
						</x-narsil::ui.section.section-root>
					</x-narsil::ui.tabs.tabs-panel>
				@endif

				<x-narsil::ui.tabs.tabs-panel
					class="overflow-y-auto"
					x-cloak
					x-show="activeTab === 'configuration'"
				>
					<x-narsil::ui.section.section-root>
						<x-narsil::ui.section.section-header
							class="border-b"
						>
							<x-narsil::ui.heading.heading-root
								level="h2"
							>
								{{ trans('narsil::ui.personalization') }}
							</x-narsil::ui.heading.heading-root>
						</x-narsil::ui.section.section-header>
						<x-narsil::ui.section.section-content>
							<form
								class="grid gap-4"
								wire:submit="save"
							>
								<x-narsil::blocks.dynamic-form
									:form="$form"
									:values="['color' => $color, 'language' => $language, 'radius' => $radius]"
								/>
								<x-narsil::ui.dialog.dialog-footer
									class="border-t"
								>
									<x-narsil::ui.dialog.dialog-close
										class="hover:bg-accent inline-flex h-9 items-center justify-center rounded-md px-3 text-sm font-medium"
									>
										{{ trans('narsil::ui.cancel') }}
									</x-narsil::ui.dialog.dialog-close>
									<x-narsil::ui.button.button-root
										type="submit"
										wire:loading.attr="disabled"
										wire:target="save"
									>
										{{ trans('narsil::ui.save') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.dialog.dialog-footer>
							</form>
						</x-narsil::ui.section.section-content>
					</x-narsil::ui.section.section-root>
				</x-narsil::ui.tabs.tabs-panel>

				@if ($authenticated)
					<x-narsil::ui.tabs.tabs-panel
						class="overflow-y-auto"
						x-cloak
						x-show="activeTab === 'security'"
					>
						<x-narsil::ui.section.section-root>
							<x-narsil::ui.section.section-header
								class="border-b"
							>
								<x-narsil::ui.heading.heading-root
									level="h2"
								>
									{{ trans('narsil::ui.security') }}
								</x-narsil::ui.heading.heading-root>
							</x-narsil::ui.section.section-header>
							<x-narsil::ui.section.section-content
								class="grid gap-4"
							>
								<div
									class="flex items-center justify-between"
								>
									<x-narsil::ui.field.field-label>
										{{ trans('narsil::ui.two_factor') }}
									</x-narsil::ui.field.field-label>
									@if ($twoFactorEnabled || $twoFactorSetupStarted)
										<x-narsil::ui.form.form-root
											:action="route('two-factor.disable')"
											class="contents"
											method="DELETE"
											x-on:change="$wire.disableTwoFactor()"
										>
											<x-narsil::blocks.switch.switch-root
												aria-label="{{ trans('narsil::ui.two_factor') }}"
												checked
												name="two_factor"
											>
											</x-narsil::blocks.switch.switch-root>
										</x-narsil::ui.form.form-root>
									@else
										<x-narsil::ui.form.form-root
											:action="route('two-factor.enable')"
											class="contents"
											x-on:change="$wire.enableTwoFactor()"
										>
											<x-narsil::blocks.switch.switch-root
												aria-label="{{ trans('narsil::ui.two_factor') }}"
												name="two_factor"
											>
											</x-narsil::blocks.switch.switch-root>
										</x-narsil::ui.form.form-root>
									@endif
								</div>
								@if ($twoFactorSetupStarted && !$twoFactorEnabled)
									<div
										class="flex max-w-48 items-center justify-center place-self-center [&>svg]:h-auto [&>svg]:w-full"
										x-data="{ qrCode: null, recoveryCodes: [] }"
										x-html="qrCode"
										x-init="Promise.all([fetch('{{ route('two-factor.qr-code') }}', { headers: { Accept: 'application/json' } }).then(response => response.json()), fetch('{{ route('two-factor.recovery-codes') }}', { headers: { Accept: 'application/json' } }).then(response => response.json())]).then(([qr, codes]) => {
		    qrCode = qr.svg;
		    recoveryCodes = codes
		})"
										x-show="qrCode"
									>
									</div>
									<x-narsil::ui.card.card-root
										class="mx-0"
										x-data="{ recoveryCodes: [] }"
										x-init="fetch('{{ route('two-factor.recovery-codes') }}', { headers: { Accept: 'application/json' } }).then(response => response.json()).then(data => recoveryCodes = data)"
									>
										<x-narsil::ui.card.card-header
											class="border-b"
										>
											<x-narsil::ui.card.card-title>{{ trans('narsil::ui.recovery_codes') }}</x-narsil::ui.card.card-title>
											<x-narsil::ui.card.card-action>
												<button
													aria-label="{{ trans('narsil::ui.copy_clipboard') }}"
													class="hover:bg-accent inline-flex size-7 cursor-pointer items-center justify-center rounded-md border border-transparent"
													type="button"
													x-on:click="navigator.clipboard.writeText(recoveryCodes.join('\n'))"
												>
													<x-narsil::ui.icon.icon-root
														name="copy"
													/>
												</button>
											</x-narsil::ui.card.card-action>
										</x-narsil::ui.card.card-header>
										<x-narsil::ui.card.card-content
											class="gap-4"
										>
											<p>{{ trans('narsil::descriptions.users.recovery_codes') }}</p>
											<ul
												class="ml-6 list-disc"
											>
												<template
													:key="code"
													x-for="code in recoveryCodes"
												>
													<li
														x-text="code"
													></li>
												</template>
											</ul>
										</x-narsil::ui.card.card-content>
									</x-narsil::ui.card.card-root>
									<x-narsil::blocks.user-settings.user-settings-form
										:form="$this->getTwoFactorForm()"
									/>
								@endif
							</x-narsil::ui.section.section-content>
						</x-narsil::ui.section.section-root>
						<x-narsil::ui.separator.separator-root />
						<x-narsil::ui.section.section-root>
							<x-narsil::ui.section.section-header
								class="border-b"
							>
								<x-narsil::ui.heading.heading-root
									level="h2"
								>
									{{ trans('narsil::ui.sessions') }}
								</x-narsil::ui.heading.heading-root>
							</x-narsil::ui.section.section-header>
							<x-narsil::ui.section.section-content
								class="grid gap-4"
							>
								<p>
									{{ trans('narsil::sessions.sign_out_current.description') }}
								</p>
								<x-narsil::ui.form.form-root
									:action="route('sessions.delete', ['type' => 'current'])"
									class="contents"
									method="DELETE"
								>
									<x-narsil::ui.button.button-root
										type="submit"
										variant="outline"
									>
										{{ trans('narsil::sessions.sign_out_current.label') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.form.form-root>
								<x-narsil::ui.separator.separator-root />
								<p>
									{{ trans('narsil::sessions.sign_out_elsewhere.description') }}
								</p>
								<x-narsil::ui.form.form-root
									:action="route('sessions.delete', ['type' => 'other'])"
									class="contents"
									method="DELETE"
								>
									<x-narsil::ui.button.button-root
										type="submit"
										variant="outline"
									>
										{{ trans('narsil::sessions.sign_out_elsewhere.label') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.form.form-root>
								<x-narsil::ui.separator.separator-root />
								<p>
									{{ trans('narsil::sessions.sign_out_everywhere.description') }}
								</p>
								<x-narsil::ui.form.form-root
									:action="route('sessions.delete', ['type' => 'all'])"
									class="contents"
									method="DELETE"
								>
									<x-narsil::ui.button.button-root
										type="submit"
										variant="outline"
									>
										{{ trans('narsil::sessions.sign_out_everywhere.label') }}
									</x-narsil::ui.button.button-root>
								</x-narsil::ui.form.form-root>
							</x-narsil::ui.section.section-content>
						</x-narsil::ui.section.section-root>
					</x-narsil::ui.tabs.tabs-panel>
				@endif
			</x-narsil::ui.tabs.tabs-root>
		</x-narsil::ui.dialog.dialog-popup>
	</x-narsil::ui.dialog.dialog-root>
</div>

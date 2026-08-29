<x-narsil::ui.card.root class="max-w-md">
    <x-narsil::ui.card.content class="p-6">
        <form class="grid grid-cols-12 gap-6" wire:submit="login">
            <div class="group/field col-span-full flex w-full flex-col gap-2">
                <label class="flex min-h-7 items-center text-sm leading-none font-medium select-none" for="email">
                    <span class="first-letter:uppercase">{{ trans('narsil::validation.attributes.email') }}</span>
                </label>
            <x-narsil::ui.input.root
                    id="email"
                    autocomplete="email"
                    name="email"
                    placeholder="email@example.com"
                    required
                    type="email"
                    wire:model="email"
                />
                @error('email')
                    <p class="text-sm text-destructive" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <div class="group/field col-span-full flex w-full flex-col gap-2">
                <div class="flex items-center justify-between gap-3">
                    <label class="flex min-h-7 items-center text-sm leading-none font-medium select-none" for="password">
                        <span class="first-letter:uppercase">{{ trans('narsil::validation.attributes.password') }}</span>
                    </label>
                    <a class="text-sm text-muted-foreground underline-offset-4 hover:text-foreground hover:underline" href="{{ route('password.request') }}">
                        {{ trans('narsil::ui.forgot_password') }}
                    </a>
                </div>
                <x-narsil::ui.input.root
                    id="password"
                    autocomplete="current-password"
                    name="password"
                    required
                    type="password"
                    wire:model="password"
                />
                @error('password')
                    <p class="text-sm text-destructive" role="alert">{{ $message }}</p>
                @enderror
            </div>

            <label class="group/field col-span-full flex w-full flex-row-reverse items-center justify-end gap-2 text-sm" for="remember">
                <input id="remember" name="remember" type="checkbox" wire:model="remember">
                {{ trans('narsil::validation.attributes.remember') }}
            </label>

            <x-narsil::ui.button.root
                class="col-span-full w-full"
                type="submit"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>{{ trans('narsil::ui.log_in') }}</span>
                <span wire:loading>{{ trans('narsil::ui.log_in') }}...</span>
            </x-narsil::ui.button.root>
        </form>
    </x-narsil::ui.card.content>
</x-narsil::ui.card.root>

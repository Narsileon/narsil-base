@props(['form', 'token' => null])

<x-narsil::ui.card.root class="max-w-md">
    <x-narsil::ui.card.content class="p-6">
        <form
            action="{{ $form->action }}"
            class="grid grid-cols-12 gap-6"
            enctype="{{ $form->id === 'profile-form' ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}"
            method="post"
        >
            @csrf
            @if ($form->method !== 'POST')
                @method($form->method)
            @endif
            @if ($token)
                <input name="token" type="hidden" value="{{ $token }}">
            @endif

            @foreach ($form->steps ?? [] as $step)
                @foreach ($step->elements ?? [] as $element)
                    @php
                        $input = $element->input;
                        $id = $element->id;
                        $type = $input->type;
                        $value = old($id, $input->defaultValue ?? '');
                        $fieldClass = $element->className ?? 'col-span-full';
                    @endphp
                    <div class="group/field {{ $fieldClass }} flex w-full flex-col gap-2">
                        @if ($type === 'checkbox')
                            <label class="flex items-center gap-2 text-sm" for="{{ $id }}">
                                <input
                                    @checked(old($id, $input->defaultValue ?? false))
                                    @disabled($element->readOnly ?? false)
                                    @required($element->required ?? false)
                                    id="{{ $id }}"
                                    name="{{ $id }}"
                                    type="checkbox"
                                    value="1"
                                >
                                {{ $element->label }}
                            </label>
                        @else
                            <label class="flex min-h-7 items-center text-sm leading-none font-medium select-none" for="{{ $id }}">
                                <span class="first-letter:uppercase">{{ $element->label }}</span>
                            </label>
                            <x-narsil::ui.input.root
                                :accept="$input->accept ?? null"
                                :autocomplete="$input->autoComplete ?? 'off'"
                                :maxlength="$input->maxLength ?? null"
                                :minlength="$input->minLength ?? null"
                                :name="$id"
                                :placeholder="$input->placeholder ?? null"
                                :readonly="$element->readOnly ?? false"
                                :required="$element->required ?? false"
                                :type="$type"
                                :value="$type === 'password' ? '' : $value"
                                id="{{ $id }}"
                            />
                            @if (($input->href ?? null) && $type === 'password')
                                <a class="text-sm text-muted-foreground underline-offset-4 hover:text-foreground hover:underline" href="{{ $input->href }}">
                                    {{ trans('narsil::ui.forgot_password') }}
                                </a>
                            @endif
                        @endif
                        @error($id)
                            <p class="text-sm text-destructive" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            @endforeach

            <x-narsil::ui.button.root
                class="col-span-full w-full"
                type="submit"
            >
                {{ $form->submitLabel }}
            </x-narsil::ui.button.root>
        </form>
    </x-narsil::ui.card.content>
    @if ($form->id === 'forgot-password-form')
        <x-narsil::ui.card.footer class="border-t px-6">
            <a
                class="group/button inline-flex h-9 w-full shrink-0 cursor-pointer items-center justify-center gap-2 rounded-md border border-transparent bg-secondary/80 bg-clip-padding px-3 py-2 font-medium whitespace-nowrap text-secondary-foreground ring-1 ring-transparent transition-all duration-300 outline-none select-none hover:bg-secondary focus-visible:border-primary focus-visible:ring-primary"
                href="{{ route('login') }}"
            >
                {{ trans('narsil::ui.back') }}
            </a>
        </x-narsil::ui.card.footer>
    @endif
</x-narsil::ui.card.root>

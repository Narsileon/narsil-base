<?php

declare(strict_types=1);

namespace Narsil\Base\Livewire;

#region USE

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Narsil\Base\Contracts\Forms\UserConfigurationForm;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;
use Illuminate\Validation\Rule;

#endregion

final class UserSettings extends Component
{
    #region PROPERTIES

    /**
     * The selected color.
     *
     * @var string
     */
    public string $color = 'gray';

    /**
     * The dynamic user configuration form.
     *
     * @var array<string,mixed>
     */
    public array $form = [];

    /**
     * The selected language.
     *
     * @var string
     */
    public string $language = 'en';

    /**
     * The selected radius.
     *
     * @var float
     */
    public float $radius = 0.25;

    #endregion

    #region PUBLIC METHODS

    /**
     * Mount the dynamic user configuration form.
     *
     * @return void
     */
    public function mount(): void
    {
        $form = app(UserConfigurationForm::class);

        $this->color = (string) (Session::get(UserConfiguration::COLOR) ?? 'gray');
        $this->form = json_decode(json_encode($form), true);
        $this->language = (string) (Session::get(UserConfiguration::LANGUAGE) ?? app()->getLocale());
        $this->radius = (float) (Session::get(UserConfiguration::RADIUS) ?? 0.25);
    }

    /**
     * Save the current user configuration.
     *
     * @return void
     */
    public function save(): void
    {
        $validated = $this->validate([
            'color' => ['required', Rule::in(ColorEnum::values())],
            'language' => ['required', 'string'],
            'radius' => ['required', 'numeric', 'min:0', 'max:1'],
        ]);

        $user = Auth::user();

        if ($user)
        {
            $configuration = UserConfiguration::query()->firstWhere([
                UserConfiguration::USER_ID => $user->{User::ID},
            ]);

            $configuration?->update($validated);
        }

        Session::put(UserConfiguration::COLOR, $validated['color']);
        Session::put(UserConfiguration::LANGUAGE, $validated['language']);
        Session::put(UserConfiguration::RADIUS, $validated['radius']);
        app()->setLocale($validated['language']);
        Session::flash('narsil_user_settings_open', true);
        Session::save();

        $this->redirect(
            request()->header('Referer') ?: url()->previous(),
            navigate: false
        );
    }

    /**
     * Render the settings modal.
     *
     * @return View
     */
    public function render(): View
    {
        return view('narsil::livewire.user-settings');
    }

    #endregion
}

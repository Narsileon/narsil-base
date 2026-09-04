<?php

declare(strict_types=1);

namespace Narsil\Base\Livewire;

#region USE

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Component;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Narsil\Base\Contracts\Forms\UserConfigurationForm;
use Narsil\Base\Contracts\Forms\Fortify\ProfileForm;
use Narsil\Base\Contracts\Forms\Fortify\TwoFactorForm;
use Narsil\Base\Contracts\Forms\Fortify\UpdatePasswordForm;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;
use Illuminate\Validation\Rule;

#endregion

final class UserSettings extends Component
{
    #region PROPERTIES

    /**
     * Whether the current user is authenticated.
     *
     * @var boolean
     */
    public bool $authenticated = false;

    /**
     * The current user profile values.
     *
     * @var array<string,mixed>
     */
    public array $profileValues = [];

    /**
     * Whether two-factor authentication setup is waiting for confirmation.
     *
     * @var boolean
     */
    public bool $twoFactorPending = false;

    /**
     * Whether two-factor setup was started during the current modal session.
     *
     * @var boolean
     */
    public bool $twoFactorSetupStarted = false;

    /**
     * Whether two-factor authentication is confirmed for the current user.
     *
     * @var boolean
     */
    public bool $twoFactorEnabled = false;

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
     * Disable two-factor authentication for the current user.
     *
     * @return void
     */
    public function disableTwoFactor(): void
    {
        $user = Auth::user();

        if ($user)
        {
            app(DisableTwoFactorAuthentication::class)($user);
        }

        $this->twoFactorEnabled = false;
        $this->twoFactorPending = false;
        $this->twoFactorSetupStarted = false;
    }

    /**
     * Start two-factor authentication setup for the current user.
     *
     * @return void
     */
    public function enableTwoFactor(): void
    {
        $user = Auth::user();

        if ($user)
        {
            app(EnableTwoFactorAuthentication::class)($user);
        }

        $this->twoFactorEnabled = false;
        $this->twoFactorPending = true;
        $this->twoFactorSetupStarted = true;
    }

    /**
     * Get the password form for the account tab.
     *
     * @return object
     */
    public function getPasswordForm(): object
    {
        return json_decode(json_encode(app(UpdatePasswordForm::class)), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Get the profile form for the account tab.
     *
     * @return object
     */
    public function getProfileForm(): object
    {
        return json_decode(json_encode(app(ProfileForm::class)), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Get the two-factor authentication form for the security tab.
     *
     * @return object
     */
    public function getTwoFactorForm(): object
    {
        return json_decode(json_encode(app(TwoFactorForm::class)), false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Mount the dynamic user configuration form.
     *
     * @return void
     */
    public function mount(): void
    {
        $form = app(UserConfigurationForm::class);

        $user = Auth::user();

        $this->authenticated = (bool) $user;
        $this->profileValues = [
            'first_name' => $user?->first_name,
            'last_name' => $user?->last_name,
        ];
        $this->twoFactorEnabled = (bool) $user?->two_factor_confirmed_at;
        $this->twoFactorPending = (bool) $user?->two_factor_secret;

        $this->color = (string) (Session::get(UserConfiguration::COLOR) ?? 'gray');
        $this->form = json_decode(json_encode($form), true);
        $this->language = (string) (Session::get(UserConfiguration::LANGUAGE) ?? app()->getLocale());
        $this->radius = (float) (Session::get(UserConfiguration::RADIUS) ?? 0.25);
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

    #endregion
}

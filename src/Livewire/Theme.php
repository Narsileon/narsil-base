<?php

declare(strict_types=1);

namespace Narsil\Base\Livewire;

#region USE

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Narsil\Base\Enums\ThemeEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

final class Theme extends Component
{
    #region PROPERTIES

    /**
     * The selected theme.
     *
     * @var string
     */
    public string $theme = ThemeEnum::SYSTEM->value;

    #endregion

    #region PUBLIC METHODS

    /**
     * Mount the theme selector.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->theme = (string) Session::get(UserConfiguration::THEME, ThemeEnum::SYSTEM->value);
    }

    /**
     * Persist and apply a theme.
     *
     * @param string $theme
     *
     * @return void
     */
    public function setTheme(string $theme): void
    {
        $this->theme = $theme;

        $this->validate([
            'theme' => ['required', Rule::enum(ThemeEnum::class)],
        ]);

        $user = Auth::user();

        if ($user)
        {
            $configuration = UserConfiguration::query()->firstWhere([
                UserConfiguration::USER_ID => $user->{User::ID},
            ]);

            $configuration?->update([
                UserConfiguration::THEME => $theme,
            ]);
        }

        Session::put(UserConfiguration::THEME, $theme);
        $this->dispatch('theme-updated', theme: $theme);
    }

    /**
     * Render the theme selector.
     *
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.block.themes.themes');
    }

    #endregion
}

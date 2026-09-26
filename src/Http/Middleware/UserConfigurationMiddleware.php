<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Middleware;

#region USE

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

class UserConfigurationMiddleware
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $userConfiguration = Auth::user()?->{User::RELATION_CONFIGURATION};

        if ($userConfiguration)
        {
            $this->setSessionColor($userConfiguration);
            $this->setSessionLanguage($userConfiguration);
            $this->setSessionRadius($userConfiguration);
            $this->setSessionTheme($userConfiguration);
        }
        else
        {
            $this->setSessionDefaultAppearance();
        }

        return $next($request);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @param UserConfiguration $userConfiguration
     *
     * @return void
     */
    protected function setSessionColor(UserConfiguration $userConfiguration): void
    {
        $color = $userConfiguration->{UserConfiguration::COLOR};

        if ($color !== null)
        {
            Session::put(UserConfiguration::COLOR, $color);
        }
    }

    /**
     * @return void
     */
    protected function setSessionDefaultAppearance(): void
    {
        $needsDefaultColor = !Session::has(UserConfiguration::COLOR);
        $needsDefaultRadius = !Session::has(UserConfiguration::RADIUS);

        if ($needsDefaultColor || $needsDefaultRadius)
        {
            $settings = Schema::hasTable(Setting::TABLE);

            if ($needsDefaultColor)
            {
                Session::put(
                    UserConfiguration::COLOR,
                    $settings
                        ? Setting::getValue(Setting::DEFAULT_COLOR, ColorEnum::GRAY->value)
                        : ColorEnum::GRAY->value,
                );
            }

            if ($needsDefaultRadius)
            {
                Session::put(
                    UserConfiguration::RADIUS,
                    $settings
                        ? (float) Setting::getValue(Setting::DEFAULT_RADIUS, 0.25)
                        : 0.25,
                );
            }
        }
    }

    /**
     * @param UserConfiguration $userConfiguration
     *
     * @return void
     */
    protected function setSessionLanguage(UserConfiguration $userConfiguration): void
    {
        $language = $userConfiguration->{UserConfiguration::LANGUAGE};

        if ($language !== null)
        {
            Session::put(UserConfiguration::LANGUAGE, $language);
        }
    }

    /**
     * @param UserConfiguration $userConfiguration
     *
     * @return void
     */
    protected function setSessionRadius(UserConfiguration $userConfiguration): void
    {
        $radius = $userConfiguration->{UserConfiguration::RADIUS};

        if ($radius !== null)
        {
            Session::put(UserConfiguration::RADIUS, $radius);
        }
    }

    /**
     * @param UserConfiguration $userConfiguration
     *
     * @return void
     */
    protected function setSessionTheme(UserConfiguration $userConfiguration): void
    {
        $theme = $userConfiguration->{UserConfiguration::THEME};

        if ($theme)
        {
            Session::put(UserConfiguration::THEME, $theme);
        }
    }

    #endregion
}

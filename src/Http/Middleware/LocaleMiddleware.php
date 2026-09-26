<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Middleware;

#region USE

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

class LocaleMiddleware
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
        $this->setApplicationLocale();

        return $next($request);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function setApplicationLocale(): void
    {
        $language = Session::get(UserConfiguration::LANGUAGE);

        if (!$language && Schema::hasTable(Setting::TABLE))
        {
            $language = Setting::getValue(Setting::BACKEND_LANGUAGE);
        }

        if ($language)
        {
            App::setLocale($language);
        }
    }

    #endregion
}

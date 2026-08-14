<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

final class FormRequestServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerFormRequests();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured form requests as singletons.
     *
     * @return void
     */
    protected function registerFormRequests(): void
    {
        $requests = app(Narsil::class)->requests();

        foreach ($requests as $abstract => $concrete)
        {
            $this->app->singleton($abstract, $concrete);
        }
    }

    #endregion
}

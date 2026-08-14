<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

final class ActionServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerActions();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured form actions as singletons.
     *
     * @return void
     */
    protected function registerActions(): void
    {
        $actions = app(Narsil::class)->actions();

        foreach ($actions as $abstract => $concrete)
        {
            $this->app->singleton($abstract, $concrete);
        }
    }

    #endregion
}

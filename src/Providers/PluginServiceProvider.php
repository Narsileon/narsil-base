<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

final class PluginServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerPlugins();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured plugins.
     *
     * @return void
     */
    protected function registerPlugins(): void
    {
        $plugins = $this->app->make(Narsil::class)->getPlugins();

        foreach ($plugins as $plugin)
        {
            $this->app->register($plugin);
        }
    }

    #endregion
}

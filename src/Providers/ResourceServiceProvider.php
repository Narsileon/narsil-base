<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

/**
 * @author Jonathan Rigaux
 */
final class ResourceServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerResources();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured resources as binding.
     *
     * @return void
     */
    protected function registerResources(): void
    {
        $resources = app(Narsil::class)->resources();

        foreach ($resources as $abstract => $concrete)
        {
            $this->app->bind($abstract, $concrete);
        }
    }

    #endregion
}

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
final class TableServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerTables();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured tables as singletons.
     *
     * @return void
     */
    protected function registerTables(): void
    {
        $tables = app(Narsil::class)->tables();

        foreach ($tables as $table => $template)
        {
            $this->app->singleton("tables.$table", $template);
        }
    }

    #endregion
}

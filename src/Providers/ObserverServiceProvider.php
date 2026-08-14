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
final class ObserverServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootObservers();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Boot the configured observers.
     *
     * @return void
     */
    protected function bootObservers(): void
    {
        $observers = app(Narsil::class)->observers();

        foreach ($observers as $model => $observer)
        {
            $model::observe($observer);
        }
    }

    #endregion
}

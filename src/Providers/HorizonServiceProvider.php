<?php

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Narsil\Base\Models\User;

#endregion

final class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user = null)
        {
            return in_array(optional($user)->{User::EMAIL}, [
                //
            ]);
        });
    }

    #endregion
}

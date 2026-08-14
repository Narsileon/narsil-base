<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;
use Narsil\Base\Models\User;

#endregion

/**
 * @author Jonathan Rigaux
 */
final class PolicyServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Gate::before(function (User $user)
        {
            if ($user->hasRole('super_admin'))
            {
                return true;
            };
        });

        $this->bootPolicies();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Boot the configured policies.
     *
     * @return void
     */
    protected function bootPolicies(): void
    {
        $policies = app(Narsil::class)->policies();

        foreach ($policies as $model => $policy)
        {
            Gate::policy($model, $policy);
        }
    }

    #endregion
}

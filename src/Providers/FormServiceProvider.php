<?php

declare(strict_types=1);

namespace Narsil\Base\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;

#endregion

final class FormServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->registerForms();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the configured forms as bindings.
     *
     * @return void
     */
    protected function registerForms(): void
    {
        $forms = app(Narsil::class)->forms();

        foreach ($forms as $abstract => $concrete)
        {
            $this->app->bind($abstract, $concrete);
        }
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Tests;

#region USE

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\FortifyServiceProvider as LaravelFortifyServiceProvider;
use Narsil\Base\Models\User;
use Narsil\Base\Providers\FortifyServiceProvider as BaseFortifyServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

#endregion

abstract class TestCase extends OrchestraTestCase
{
    #region PROTECTED METHODS

    /**
     * @param Application $app
     *
     * @return void
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('auth.defaults.guard', 'web');
        $app['config']->set('auth.guards.web.driver', 'session');
        $app['config']->set('auth.guards.web.provider', 'users');
        $app['config']->set('auth.providers.users.driver', 'eloquent');
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');
        $app['config']->set('fortify.home', '/dashboard');
    }

    /**
     * @param Application $app
     *
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelFortifyServiceProvider::class,
            BaseFortifyServiceProvider::class,
        ];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/dashboard', function ()
        {
            return response('Dashboard');
        })->name('dashboard');
    }

    #endregion
}

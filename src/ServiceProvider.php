<?php

declare(strict_types=1);

namespace Narsil\Base;

#region USE

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Livewire\Livewire;
use Narsil\Base\Providers\PluginServiceProvider;
use Narsil\Base\Services\ModelEventService;
use Narsil\Base\Services\ModelRouteRegistrar;
use Narsil\Base\Services\TableRegistry;
use Narsil\Base\View\Components\Block\AuthHeader;
use Narsil\Base\View\Components\Ui\Icon\Root;
use Narsil\Base\Livewire\Theme;
use Narsil\Base\Livewire\UserSettings;

#endregion

class ServiceProvider extends BaseServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Boot any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootRoutes();
        $this->bootTranslations();
        $this->bootViews();
        $this->bootLivewireComponents();

        app(ModelEventService::class)->register();

        Route::middleware([
            'web',
            'narsil',
            'auth',
            'verified',
        ])
            ->prefix('narsil')
            ->group(function ()
            {
                app(ModelRouteRegistrar::class)->register('Narsil\\Base\\');
            });
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $this->app->singleton(Narsil::class, function ()
        {
            return new Narsil();
        });

        $this->app->singleton(TableRegistry::class);

        $this->registerDefaults();

        $this->app->booting(function ()
        {
            $this->app->register(PluginServiceProvider::class);
        });
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Register the package defaults.
     *
     * @return void
     */
    protected function registerDefaults(): void
    {
        $narsil = $this->app->make(Narsil::class);

        $narsil
            ->action(\Narsil\Base\Contracts\Actions\Roles\ReplicateRole::class, \Narsil\Base\Implementations\Actions\Roles\ReplicateRole::class)
            ->action(\Narsil\Base\Contracts\Actions\Roles\SyncRolePermissions::class, \Narsil\Base\Implementations\Actions\Roles\SyncRolePermissions::class)
            ->action(\Narsil\Base\Contracts\Actions\Users\SyncUserPermissions::class, \Narsil\Base\Implementations\Actions\Users\SyncUserPermissions::class)
            ->action(\Narsil\Base\Contracts\Actions\Users\SyncUserRoles::class, \Narsil\Base\Implementations\Actions\Users\SyncUserRoles::class)
            ->form(\Narsil\Base\Contracts\Forms\AssetForm::class, \Narsil\Base\Implementations\Forms\AssetForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\ConfirmPasswordForm::class, \Narsil\Base\Implementations\Forms\Fortify\ConfirmPasswordForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\ForgotPasswordForm::class, \Narsil\Base\Implementations\Forms\Fortify\ForgotPasswordForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\LoginForm::class, \Narsil\Base\Implementations\Forms\Fortify\LoginForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\ProfileForm::class, \Narsil\Base\Implementations\Forms\Fortify\ProfileForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\RegisterForm::class, \Narsil\Base\Implementations\Forms\Fortify\RegisterForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\ResetPasswordForm::class, \Narsil\Base\Implementations\Forms\Fortify\ResetPasswordForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\TwoFactorChallengeForm::class, \Narsil\Base\Implementations\Forms\Fortify\TwoFactorChallengeForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\TwoFactorForm::class, \Narsil\Base\Implementations\Forms\Fortify\TwoFactorForm::class)
            ->form(\Narsil\Base\Contracts\Forms\Fortify\UpdatePasswordForm::class, \Narsil\Base\Implementations\Forms\Fortify\UpdatePasswordForm::class)
            ->form(\Narsil\Base\Contracts\Forms\PermissionForm::class, \Narsil\Base\Implementations\Forms\PermissionForm::class)
            ->form(\Narsil\Base\Contracts\Forms\RoleForm::class, \Narsil\Base\Implementations\Forms\RoleForm::class)
            ->form(\Narsil\Base\Contracts\Forms\TanStackTableForm::class, \Narsil\Base\Implementations\Forms\TanStackTableForm::class)
            ->form(\Narsil\Base\Contracts\Forms\UserBookmarkForm::class, \Narsil\Base\Implementations\Forms\UserBookmarkForm::class)
            ->form(\Narsil\Base\Contracts\Forms\UserConfigurationForm::class, \Narsil\Base\Implementations\Forms\UserConfigurationForm::class)
            ->form(\Narsil\Base\Contracts\Forms\UserForm::class, \Narsil\Base\Implementations\Forms\UserForm::class)
            ->menu(\Narsil\Base\Contracts\Menus\Home::class, \Narsil\Base\Implementations\Menus\Home::class)
            ->menu(\Narsil\Base\Contracts\Menus\HomeSidebar::class, \Narsil\Base\Implementations\Menus\HomeSidebar::class)
            ->modelDefinition(\Narsil\Base\Models\User::class, \Narsil\Base\Definitions\UserDefinition::class)
            ->modelDefinition(\Narsil\Base\Models\Policies\Permission::class, \Narsil\Base\Definitions\PermissionDefinition::class)
            ->modelDefinition(\Narsil\Base\Models\Policies\Role::class, \Narsil\Base\Definitions\RoleDefinition::class)
            ->modelDefinition(\Narsil\Base\Models\Storages\Asset::class, \Narsil\Base\Definitions\AssetDefinition::class)
            ->request(\Narsil\Base\Contracts\Requests\AssetFormRequest::class, \Narsil\Base\Implementations\Requests\AssetFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\Fortify\CreateNewUserFormRequest::class, \Narsil\Base\Implementations\Requests\Fortify\CreateNewUserFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\Fortify\ResetUserPasswordFormRequest::class, \Narsil\Base\Implementations\Requests\Fortify\ResetUserPasswordFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\Fortify\UpdateUserPasswordFormRequest::class, \Narsil\Base\Implementations\Requests\Fortify\UpdateUserPasswordFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\Fortify\UpdateUserProfileInformationFormRequest::class, \Narsil\Base\Implementations\Requests\Fortify\UpdateUserProfileInformationFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\PermissionFormRequest::class, \Narsil\Base\Implementations\Requests\PermissionFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\RoleFormRequest::class, \Narsil\Base\Implementations\Requests\RoleFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\TanStackTableFormRequest::class, \Narsil\Base\Implementations\Requests\TanStackTableFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\UserBookmarkFormRequest::class, \Narsil\Base\Implementations\Requests\UserBookmarkFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\UserConfigurationFormRequest::class, \Narsil\Base\Implementations\Requests\UserConfigurationFormRequest::class)
            ->request(\Narsil\Base\Contracts\Requests\UserFormRequest::class, \Narsil\Base\Implementations\Requests\UserFormRequest::class)
            ->resource(\Narsil\Base\Contracts\Resources\UserResource::class, \Narsil\Base\Implementations\Resources\UserResource::class)
            ->locales([
                'en',
                'de',
                'fr',
            ]);
    }


    /**
     * Boot the migrations.
     *
     * @return void
     */
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }

    /**
     * Boot the routes.
     *
     * @return void
     */
    protected function bootRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Boot the translations.
     *
     * @return void
     */
    protected function bootTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'narsil');
    }

    /**
     * Boot the views.
     *
     * @return void
     */
    protected function bootViews(): void
    {
        $this->loadViewsFrom([
            __DIR__ . '/../resources/views',
        ], 'narsil');
        Blade::anonymousComponentPath(__DIR__ . '/../resources/views/components', 'narsil');
        Blade::component('narsil::block.auth-header', AuthHeader::class);
        Blade::component('narsil::ui.icon.root', Root::class);
    }

    /**
     * Boot the Livewire components.
     *
     * @return void
     */
    protected function bootLivewireComponents(): void
    {
        Livewire::component('narsil-theme', Theme::class);
        Livewire::component('narsil-user-settings', UserSettings::class);
    }

    #endregion
}

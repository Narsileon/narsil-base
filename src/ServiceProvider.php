<?php

declare(strict_types=1);

namespace Narsil\Base;

#region USE

use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Livewire\Livewire;
use Narsil\Base\Console\Commands\SyncPermissions;
use Narsil\Base\Contracts\Actions\Roles\ReplicateRole;
use Narsil\Base\Contracts\Actions\Roles\SyncRolePermissions;
use Narsil\Base\Contracts\Actions\Users\SyncUserPermissions;
use Narsil\Base\Contracts\Actions\Users\SyncUserRoles;
use Narsil\Base\Contracts\Forms\AiProviderForm;
use Narsil\Base\Contracts\Forms\AssetForm;
use Narsil\Base\Contracts\Forms\Fortify\ConfirmPasswordForm;
use Narsil\Base\Contracts\Forms\Fortify\ForgotPasswordForm;
use Narsil\Base\Contracts\Forms\Fortify\LoginForm;
use Narsil\Base\Contracts\Forms\Fortify\ProfileForm;
use Narsil\Base\Contracts\Forms\Fortify\RegisterForm;
use Narsil\Base\Contracts\Forms\Fortify\ResetPasswordForm;
use Narsil\Base\Contracts\Forms\Fortify\TwoFactorChallengeForm;
use Narsil\Base\Contracts\Forms\Fortify\TwoFactorForm;
use Narsil\Base\Contracts\Forms\Fortify\UpdatePasswordForm;
use Narsil\Base\Contracts\Forms\PermissionForm;
use Narsil\Base\Contracts\Forms\RoleForm;
use Narsil\Base\Contracts\Forms\SettingsForm;
use Narsil\Base\Contracts\Forms\TanStackTableForm;
use Narsil\Base\Contracts\Forms\UserBookmarkForm;
use Narsil\Base\Contracts\Forms\UserConfigurationForm;
use Narsil\Base\Contracts\Forms\UserForm;
use Narsil\Base\Contracts\Menus\AuthMenu;
use Narsil\Base\Contracts\Menus\GuestMenu;
use Narsil\Base\Contracts\Menus\Home;
use Narsil\Base\Contracts\Menus\HomeSidebar;
use Narsil\Base\Contracts\Requests\AiProviderFormRequest;
use Narsil\Base\Contracts\Requests\AssetFormRequest;
use Narsil\Base\Contracts\Requests\Fortify\CreateNewUserFormRequest;
use Narsil\Base\Contracts\Requests\Fortify\ResetUserPasswordFormRequest;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserPasswordFormRequest;
use Narsil\Base\Contracts\Requests\Fortify\UpdateUserProfileInformationFormRequest;
use Narsil\Base\Contracts\Requests\PermissionFormRequest;
use Narsil\Base\Contracts\Requests\RoleFormRequest;
use Narsil\Base\Contracts\Requests\SettingsFormRequest;
use Narsil\Base\Contracts\Requests\TanStackTableFormRequest;
use Narsil\Base\Contracts\Requests\UserBookmarkFormRequest;
use Narsil\Base\Contracts\Requests\UserConfigurationFormRequest;
use Narsil\Base\Contracts\Requests\UserFormRequest;
use Narsil\Base\Contracts\Resources\UserResource;
use Narsil\Base\Definitions\AiProviderDefinition;
use Narsil\Base\Definitions\AssetDefinition;
use Narsil\Base\Definitions\PermissionDefinition;
use Narsil\Base\Definitions\RoleDefinition;
use Narsil\Base\Definitions\SettingDefinition;
use Narsil\Base\Definitions\UserDefinition;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Livewire\InputRelations;
use Narsil\Base\Livewire\Theme;
use Narsil\Base\Livewire\UserSettings;
use Narsil\Base\Models\AiProvider;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;
use Narsil\Base\Providers\PluginServiceProvider;
use Narsil\Base\Services\LocaleService;
use Narsil\Base\Services\ModelEventService;
use Narsil\Base\Services\ModelRouteRegistrar;
use Narsil\Base\Services\TableRegistry;

#endregion

class ServiceProvider extends BaseServiceProvider
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootCommands();
        $this->bootMigrationEvents();
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
     * @return void
     */
    protected function bootCommands(): void
    {
        $this->commands([
            SyncPermissions::class,
        ]);
    }

    /**
     * @return void
     */
    protected function bootLivewireComponents(): void
    {
        Livewire::component('narsil-input-relations', InputRelations::class);
        Livewire::component('narsil-theme', Theme::class);
        Livewire::component('narsil-user-settings', UserSettings::class);
    }

    /**
     * @return void
     */
    protected function bootMigrationEvents(): void
    {
        Event::listen(MigrationsEnded::class, function (): void
        {
            Cache::flush();

            if (Schema::hasTable(Permission::TABLE))
            {
                Artisan::call('narsil:sync-permissions');
            }
        });
    }

    /**
     * @return void
     */
    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }

    /**
     * @return void
     */
    protected function bootRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * @return void
     */
    protected function bootTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'narsil');
    }

    /**
     * @return void
     */
    protected function bootViews(): void
    {
        $this->loadViewsFrom([
            __DIR__ . '/../resources/views',
        ], 'narsil');

        Blade::componentNamespace('Narsil\\Base\\View\\Components', 'narsil');

        View::composer('narsil::layouts.auth', function ($view): void
        {
            $home = app(Home::class)->jsonSerialize();
            $settings = Schema::hasTable(Setting::TABLE)
                ? Setting::getValues()
                : [];
            $sidebars = [
                'base' => app(HomeSidebar::class)->jsonSerialize(),
            ];

            $cmsSidebar = 'Narsil\\Cms\\Contracts\\Menus\\CmsSidebar';

            if (class_exists($cmsSidebar) || interface_exists($cmsSidebar))
            {
                $sidebars['cms'] = app($cmsSidebar)->jsonSerialize();
            }

            $name = str_starts_with(request()->path(), 'narsil/cms') ? 'cms' : 'base';

            $view->with([
                'auth' => Auth::user(),
                'defaultColor' => $settings[Setting::DEFAULT_COLOR] ?? ColorEnum::GRAY->value,
                'defaultRadius' => (float) ($settings[Setting::DEFAULT_RADIUS] ?? 0.25),
                'menu' => app(Auth::check() ? AuthMenu::class : GuestMenu::class)->jsonSerialize(),
                'navigation' => [
                    'breadcrumb' => $this->getBreadcrumbs(),
                    'home' => $home,
                    'sidebars' => $sidebars,
                ],
                'session' => $this->getSession(),
                'sidebar' => $sidebars[$name] ?? [],
                'sidebarName' => $name,
            ]);
        });
    }

    /**
     * @return array
     */
    private function getBreadcrumbs(): array
    {
        $service = 'Narsil\\Cms\\Services\\BreadcrumbService';

        if (class_exists($service))
        {
            return $service::getBreadcrumbs(request());
        }

        return [];
    }

    /**
     * @return array<string,mixed>
     */
    private function getSession(): array
    {
        return [
            'languages' => LocaleService::languageOptions(app(Narsil::class)->getLocales()),
            'locale' => app()->getLocale(),
            UserConfiguration::COLOR => Session::get(UserConfiguration::COLOR),
            UserConfiguration::RADIUS => Session::get(UserConfiguration::RADIUS),
            UserConfiguration::THEME => Session::get(UserConfiguration::THEME),
        ];
    }

    /**
     * @return void
     */
    protected function registerDefaults(): void
    {
        $narsil = $this->app->make(Narsil::class);

        $narsil
            ->action(ReplicateRole::class, Implementations\Actions\Roles\ReplicateRole::class)
            ->action(SyncRolePermissions::class, Implementations\Actions\Roles\SyncRolePermissions::class)
            ->action(SyncUserPermissions::class, Implementations\Actions\Users\SyncUserPermissions::class)
            ->action(SyncUserRoles::class, Implementations\Actions\Users\SyncUserRoles::class)
            ->form(AssetForm::class, Implementations\Forms\AssetForm::class)
            ->form(AiProviderForm::class, Implementations\Forms\AiProviderForm::class)
            ->form(ConfirmPasswordForm::class, Implementations\Forms\Fortify\ConfirmPasswordForm::class)
            ->form(ForgotPasswordForm::class, Implementations\Forms\Fortify\ForgotPasswordForm::class)
            ->form(LoginForm::class, Implementations\Forms\Fortify\LoginForm::class)
            ->form(ProfileForm::class, Implementations\Forms\Fortify\ProfileForm::class)
            ->form(RegisterForm::class, Implementations\Forms\Fortify\RegisterForm::class)
            ->form(ResetPasswordForm::class, Implementations\Forms\Fortify\ResetPasswordForm::class)
            ->form(TwoFactorChallengeForm::class, Implementations\Forms\Fortify\TwoFactorChallengeForm::class)
            ->form(TwoFactorForm::class, Implementations\Forms\Fortify\TwoFactorForm::class)
            ->form(UpdatePasswordForm::class, Implementations\Forms\Fortify\UpdatePasswordForm::class)
            ->form(PermissionForm::class, Implementations\Forms\PermissionForm::class)
            ->form(RoleForm::class, Implementations\Forms\RoleForm::class)
            ->form(SettingsForm::class, Implementations\Forms\SettingsForm::class)
            ->form(TanStackTableForm::class, Implementations\Forms\TanStackTableForm::class)
            ->form(UserBookmarkForm::class, Implementations\Forms\UserBookmarkForm::class)
            ->form(UserConfigurationForm::class, Implementations\Forms\UserConfigurationForm::class)
            ->form(UserForm::class, Implementations\Forms\UserForm::class)
            ->menu(Home::class, Implementations\Menus\Home::class)
            ->menu(HomeSidebar::class, Implementations\Menus\HomeSidebar::class)
            ->modelDefinition(AiProvider::class, AiProviderDefinition::class)
            ->modelDefinition(User::class, UserDefinition::class)
            ->modelDefinition(Permission::class, PermissionDefinition::class)
            ->modelDefinition(Role::class, RoleDefinition::class)
            ->modelDefinition(Setting::class, SettingDefinition::class)
            ->modelDefinition(Asset::class, AssetDefinition::class)
            ->request(AiProviderFormRequest::class, Implementations\Requests\AiProviderFormRequest::class)
            ->request(AssetFormRequest::class, Implementations\Requests\AssetFormRequest::class)
            ->request(CreateNewUserFormRequest::class, Implementations\Requests\Fortify\CreateNewUserFormRequest::class)
            ->request(ResetUserPasswordFormRequest::class, Implementations\Requests\Fortify\ResetUserPasswordFormRequest::class)
            ->request(UpdateUserPasswordFormRequest::class, Implementations\Requests\Fortify\UpdateUserPasswordFormRequest::class)
            ->request(UpdateUserProfileInformationFormRequest::class, Implementations\Requests\Fortify\UpdateUserProfileInformationFormRequest::class)
            ->request(PermissionFormRequest::class, Implementations\Requests\PermissionFormRequest::class)
            ->request(RoleFormRequest::class, Implementations\Requests\RoleFormRequest::class)
            ->request(SettingsFormRequest::class, Implementations\Requests\SettingsFormRequest::class)
            ->request(TanStackTableFormRequest::class, Implementations\Requests\TanStackTableFormRequest::class)
            ->request(UserBookmarkFormRequest::class, Implementations\Requests\UserBookmarkFormRequest::class)
            ->request(UserConfigurationFormRequest::class, Implementations\Requests\UserConfigurationFormRequest::class)
            ->request(UserFormRequest::class, Implementations\Requests\UserFormRequest::class)
            ->resource(UserResource::class, Implementations\Resources\UserResource::class)
            ->locales([
                'en',
                'de',
                'fr',
            ]);
    }

    #endregion
}

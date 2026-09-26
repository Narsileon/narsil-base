<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Menus;

#region USE

use Narsil\Base\Contracts\Menus\HomeSidebar as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\Menu;
use Narsil\Base\Models\AiProvider;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Models\User;
use Narsil\Base\Services\DatabaseService;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\PermissionService;
use Narsil\Base\Support\MenuItem;

#endregion

final class HomeSidebar extends Menu implements Contract
{
    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function content(): array
    {
        $this->addManagementGroup();
        $this->addAiGroup();
        $this->addToolsGroup();

        return parent::content();
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function addAiGroup(): void
    {
        $this->add(
            new MenuItem(DatabaseService::getUnqualifiedTableName(AiProvider::TABLE))
                ->group(trans('narsil::ui.ai'))
                ->icon('fa-solid-robot')
                ->label(ModelService::getTableLabel(AiProvider::TABLE))
                ->route('ai-providers.index')
                ->permissions([
                    PermissionService::getName(AiProvider::TABLE, AbilityEnum::VIEW_ANY),
                ])
        );
    }

    /**
     * @return void
     */
    private function addManagementGroup(): void
    {
        $group = trans('narsil::ui.management');

        $this
            ->add(
                new MenuItem(DatabaseService::getUnqualifiedTableName(Asset::TABLE))
                    ->group($group)
                    ->icon('fa-solid-cloud')
                    ->label(ModelService::getTableLabel(Asset::TABLE))
                    ->route('assets.index')
                    ->permissions([
                        PermissionService::getName(Asset::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(DatabaseService::getUnqualifiedTableName(User::TABLE))
                    ->group($group)
                    ->icon('fa-solid-user')
                    ->label(ModelService::getTableLabel(User::TABLE))
                    ->route('users.index')
                    ->permissions([
                        PermissionService::getName(User::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(DatabaseService::getUnqualifiedTableName(Role::TABLE))
                    ->group($group)
                    ->icon('fa-solid-user-shield')
                    ->label(ModelService::getTableLabel(Role::TABLE))
                    ->route('roles.index')
                    ->permissions([
                        PermissionService::getName(Role::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(DatabaseService::getUnqualifiedTableName(Permission::TABLE))
                    ->group($group)
                    ->icon('fa-solid-shield')
                    ->label(ModelService::getTableLabel(Permission::TABLE))
                    ->route('permissions.index')
                    ->permissions([
                        PermissionService::getName(Permission::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(DatabaseService::getUnqualifiedTableName(Setting::TABLE))
                    ->group($group)
                    ->icon('fa-regular-gear')
                    ->label(ModelService::getTableLabel(Setting::TABLE))
                    ->route('narsil.settings.edit')
                    ->permissions([
                        PermissionService::getName(Setting::TABLE, AbilityEnum::UPDATE),
                    ])
            );
    }

    /**
     * @return void
     */
    private function addToolsGroup(): void
    {
        $this->add(
            new MenuItem('horizon')
                ->group(trans('narsil::ui.tools'))
                ->icon('fa-solid-gauge-high')
                ->label('Horizon')
                ->route('horizon.index')
                ->target('_blank')
        );
    }

    #endregion
}

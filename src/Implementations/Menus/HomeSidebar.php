<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Menus;

#region USE

use Narsil\Base\Contracts\Menus\HomeSidebar as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\Menu;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\PermissionService;
use Narsil\Base\Support\MenuItem;

#endregion

final class HomeSidebar extends Menu implements Contract
{
    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function addToolsGroup(): void
    {
        $this->add(
            new MenuItem('horizon')
                ->group(trans('narsil::ui.tools'))
                ->icon('horizon')
                ->label('Horizon')
                ->route('horizon.index')
                ->target('_blank')
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function content(): array
    {
        $group = trans('narsil::ui.management');

        $this
            ->add(
                new MenuItem(Asset::TABLE)
                    ->group($group)
                    ->icon('cloud')
                    ->label(ModelService::getTableLabel(Asset::TABLE))
                    ->route('assets.index')
                    ->permissions([
                        PermissionService::getName(Asset::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(User::TABLE)
                    ->group($group)
                    ->icon('user')
                    ->label(ModelService::getTableLabel(User::TABLE))
                    ->route('users.index')
                    ->permissions([
                        PermissionService::getName(User::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(Role::TABLE)
                    ->group($group)
                    ->icon('role')
                    ->label(ModelService::getTableLabel(Role::TABLE))
                    ->route('roles.index')
                    ->permissions([
                        PermissionService::getName(Role::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            )
            ->add(
                new MenuItem(Permission::TABLE)
                    ->group($group)
                    ->icon('permission')
                    ->label(ModelService::getTableLabel(Permission::TABLE))
                    ->route('permissions.index')
                    ->permissions([
                        PermissionService::getName(Permission::TABLE, AbilityEnum::VIEW_ANY),
                    ])
            );

        $this->addToolsGroup();

        return parent::content();
    }

    #endregion
}

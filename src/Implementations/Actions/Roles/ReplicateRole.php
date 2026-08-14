<?php

namespace Narsil\Base\Implementations\Actions\Roles;

#region USE

use Narsil\Base\Contracts\Actions\Roles\ReplicateRole as Contract;
use Narsil\Base\Contracts\Actions\Roles\SyncRolePermissions;
use Narsil\Base\Implementations\Action;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\DatabaseService;

#endregion

class ReplicateRole extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Role $role): Role
    {
        $replicated = $role->replicate();

        $replicated
            ->fill([
                Role::NAME => DatabaseService::generateUniqueValue($replicated, Role::NAME, $role->{Role::NAME}),
            ])
            ->save();

        $permissions = $role->{Role::RELATION_PERMISSIONS}->pluck(Permission::ID)->toArray();

        app(SyncRolePermissions::class)
            ->run($replicated, $permissions);

        return $replicated;
    }

    #endregion
}

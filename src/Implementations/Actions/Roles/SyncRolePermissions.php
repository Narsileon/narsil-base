<?php

namespace Narsil\Base\Implementations\Actions\Roles;

#region USE

use Narsil\Base\Contracts\Actions\Roles\SyncRolePermissions as Contract;
use Narsil\Base\Implementations\Action;
use Narsil\Base\Models\Policies\Role;

#endregion

class SyncRolePermissions extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(Role $role, array $permissions): Role
    {
        $role
            ->permissions()
            ->sync($permissions);

        return $role;
    }

    #endregion
}

<?php

namespace Narsil\Base\Implementations\Actions\Users;

#region USE

use Narsil\Base\Contracts\Actions\Users\SyncUserRoles as Contract;
use Narsil\Base\Implementations\Action;
use Narsil\Base\Models\User;

#endregion

class SyncUserRoles extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(User $user, array $roles): User
    {
        $user
            ->roles()
            ->sync($roles);

        return $user;
    }

    #endregion
}

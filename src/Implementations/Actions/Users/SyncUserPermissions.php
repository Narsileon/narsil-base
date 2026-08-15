<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Actions\Users;

#region USE

use Narsil\Base\Contracts\Actions\Users\SyncUserPermissions as Contract;
use Narsil\Base\Implementations\Action;
use Narsil\Base\Models\User;

#endregion

class SyncUserPermissions extends Action implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function run(User $user, array $permissions): User
    {
        $user
            ->permissions()
            ->sync($permissions);

        return $user;
    }

    #endregion
}

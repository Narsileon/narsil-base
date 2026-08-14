<?php

namespace Narsil\Base\Contracts\Actions\Users;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Base\Models\User;

#endregion

interface SyncUserPermissions extends Action
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param integer[] $permissions
     *
     * @return User
     */
    public function run(User $user, array $permissions): User;

    #endregion
}

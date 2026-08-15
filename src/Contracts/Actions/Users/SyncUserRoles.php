<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts\Actions\Users;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Base\Models\User;

#endregion

interface SyncUserRoles extends Action
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param integer[] $roles
     *
     * @return User
     */
    public function run(User $user, array $roles): User;

    #endregion
}

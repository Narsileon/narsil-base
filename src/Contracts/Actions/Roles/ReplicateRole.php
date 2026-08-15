<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts\Actions\Roles;

#region USE

use Narsil\Base\Contracts\Action;
use Narsil\Base\Models\Policies\Role;

#endregion

interface ReplicateRole extends Action
{
    #region PUBLIC METHODS

    /**
     * @param Role $role
     *
     * @return Role
     */
    public function run(Role $role): Role;

    #endregion
}

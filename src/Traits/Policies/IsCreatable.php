<?php

declare(strict_types=1);

namespace Narsil\Base\Traits\Policies;

#region USE

use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Services\PermissionService;

#endregion

trait IsCreatable
{
    #region PUBLIC METHODS

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param string $model
     *
     * @return boolean
     */
    public function create(User $user, string $model): bool
    {
        $permission = PermissionService::getName($model::TABLE, AbilityEnum::CREATE);

        return $user->hasPermission($permission);
    }

    #endregion
}

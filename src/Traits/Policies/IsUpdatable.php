<?php

namespace Narsil\Base\Traits\Policies;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Services\PermissionService;

#endregion

trait IsUpdatable
{
    #region PUBLIC METHODS

    /**
     * Determine whether the user can update the block.
     *
     * @param User $user
     * @param Model $model
     *
     * @return boolean
     */
    public function update(User $user, Model $model): bool
    {
        $permission = PermissionService::getName($model->getTable(), AbilityEnum::UPDATE);

        return $user->hasPermission($permission);
    }

    #endregion
}

<?php

namespace Narsil\Base\Traits\Policies;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Services\PermissionService;

#endregion

trait IsViewable
{
    #region PUBLIC METHODS

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Model $model
     *
     * @return boolean
     */
    public function view(User $user, Model $model): bool
    {
        $permission = PermissionService::getName($model->getTable(), AbilityEnum::VIEW);

        return $user->hasPermission($permission);
    }

    /**
     * Determine whether the user can view models.
     *
     * @param User $user
     * @param string $model
     *
     * @return boolean
     */
    public function viewAny(User $user, string $model): bool
    {
        $permission = PermissionService::getName($model::TABLE, AbilityEnum::VIEW);

        return $user->hasPermission($permission);
    }

    #endregion
}

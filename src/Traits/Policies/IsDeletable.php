<?php

declare(strict_types=1);

namespace Narsil\Base\Traits\Policies;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Services\PermissionService;

#endregion

trait IsDeletable
{
    #region PUBLIC METHODS

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Model $model
     *
     * @return boolean
     */
    public function delete(User $user, Model $model): bool
    {
        $permission = PermissionService::getName($model->getTable(), AbilityEnum::DELETE);

        return $user->hasPermission($permission);
    }

    /**
     * Determine whether the user can delete models.
     *
     * @param User $user
     * @param string $model
     *
     * @return boolean
     */
    public function deleteAny(User $user, string $model): bool
    {
        $permission = PermissionService::getName($model::TABLE, AbilityEnum::DELETE);

        return $user->hasPermission($permission);
    }

    #endregion
}

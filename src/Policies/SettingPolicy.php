<?php

declare(strict_types=1);

namespace Narsil\Base\Policies;

#region USE

use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\Setting;
use Narsil\Base\Models\User;
use Narsil\Base\Services\PermissionService;

#endregion

class SettingPolicy
{
    #region PUBLIC METHODS

    /**
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function update(User $user, Setting $setting): bool
    {
        return $user->hasPermission(PermissionService::getName(Setting::TABLE, AbilityEnum::UPDATE));
    }

    #endregion
}

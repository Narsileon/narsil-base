<?php

declare(strict_types=1);

namespace Narsil\Base\Traits;

#region USE

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;

#endregion

trait HasPermissions
{
    #region CONSTANTS

    #region • COUNTS

    /**
     * The name of the "permissions" count.
     *
     * @var string
     */
    final public const COUNT_PERMISSIONS = 'permissions_count';

    #endregion

    #region • RELATIONS

    /**
     * The name of the "permissions" relation.
     *
     * @var string
     */
    final public const RELATION_PERMISSIONS = 'permissions';

    #endregion

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string|integer $permission
     *
     * @return bool
     */
    final public function hasPermission(string|int $permission): bool
    {
        if ($permission = $this->findPermission($permission))
        {
            return $this->hasPermissionViaPermissions($permission) || $this->hasPermissionViaRoles($permission);
        }

        return true;
    }

    #region • RELATIONSHIPS

    /**
     * Get the associated permissions.
     *
     * @return BelongsToMany
     */
    abstract public function permissions(): BelongsToMany;

    #endregion

    #endregion

    #region PROTECTED METHODS

    /**
     * @param string|integer $permission
     *
     * @return Permission|null
     */
    protected function findPermission(string|int $permission): ?Permission
    {
        return Permission::query()
            ->when(
                is_int($permission),
                function ($query) use ($permission)
                {
                    $query->where(Permission::ID, $permission);
                },
                function ($query) use ($permission)
                {
                    $query->where(Permission::NAME, $permission);
                }
            )
            ->first();
    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    final protected function hasPermissionViaPermissions(Permission $permission): bool
    {
        $this->loadMissing([
            self::RELATION_PERMISSIONS
        ]);

        return $this->{self::RELATION_PERMISSIONS}->contains(Permission::ID, $permission->{Permission::ID});
    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    final protected function hasPermissionViaRoles(Permission $permission): bool
    {
        if (!method_exists($this, 'hasRole'))
        {
            return false;
        }

        $roles = $permission->{Permission::RELATION_ROLES}->pluck(Role::NAME)->toArray();

        return $this->hasRole($roles);
    }

    #endregion
}

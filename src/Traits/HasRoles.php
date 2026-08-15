<?php

declare(strict_types=1);

namespace Narsil\Base\Traits;

#region USE

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Narsil\Base\Models\Policies\Role;

#endregion

trait HasRoles
{
    #region CONSTANTS

    #region • COUNTS

    /**
     * The name of the "roles" count.
     *
     * @var string
     */
    final public const COUNT_ROLES = 'roles_count';

    #endregion

    #region • RELATIONS

    /**
     * The name of the "roles" relation.
     *
     * @var string
     */
    final public const RELATION_ROLES = 'roles';

    #endregion

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string|integer|string[]|integer[] $roles
     *
     * @return bool
     */
    final public function hasRole(string|int|array $roles): bool
    {
        $this->loadMissing([
            self::RELATION_ROLES
        ]);

        $hasRole = false;

        if (is_string($roles))
        {
            $hasRole = $this->{self::RELATION_ROLES}->contains(Role::NAME, $roles);
        }
        else if (is_int($roles))
        {
            $hasRole = $this->{self::RELATION_ROLES}->contains(Role::ID, $roles);
        }
        else if (is_array($roles))
        {
            foreach ($roles as $role)
            {
                if ($this->hasRole($role))
                {
                    $hasRole = true;

                    break;
                }
            }
        }

        return $hasRole;
    }

    #region • RELATIONSHIPS

    /**
     * Get the associated roles.
     *
     * @return BelongsToMany
     */
    abstract public function roles(): BelongsToMany;

    #endregion

    #endregion
}

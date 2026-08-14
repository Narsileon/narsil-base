<?php

namespace Narsil\Base\Models\Policies;

#region USE

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Interfaces\Searchable;
use Narsil\Base\Models\User;
use Narsil\Base\Observers\ModelObserver;
use Narsil\Base\Policies\RolePolicy;
use Narsil\Base\Traits\AuditLoggable;
use Narsil\Base\Traits\Blameable;
use Narsil\Base\Traits\HasDatetimes;
use Narsil\Base\Traits\HasIdentifier;
use Narsil\Base\Traits\HasPermissions;
use Narsil\Base\Traits\HasTranslations;

#endregion

#[ObservedBy(ModelObserver::class)]
#[UsePolicy(RolePolicy::class)]
class Role extends Model implements Searchable
{
    use AuditLoggable;
    use Blameable;
    use HasDatetimes;
    use HasIdentifier;
    use HasPermissions;
    use HasTranslations;

    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;

        $this->translatable = [
            self::LABEL,
        ];

        $this->mergeGuarded([
            self::ID,
            self::RELATION_PERMISSIONS,
        ]);

        parent::__construct($attributes);
    }

    #endregion

    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    final public const TABLE = 'roles';

    #region • COLUMNS

    /**
     * The name of the "id" column.
     *
     * @var string
     */
    final public const ID = 'id';

    /**
     * The name of the "label" column.
     *
     * @var string
     */
    final public const LABEL = 'label';

    /**
     * The name of the "name" column.
     *
     * @var string
     */
    final public const NAME = 'name';

    #endregion

    #region • COUNTS

    /**
     * The name of the "users" count.
     *
     * @var string
     */
    final public const COUNT_USERS = 'users_count';

    #endregion

    #region • RELATIONS

    /**
     * The name of the "users" relation.
     *
     * @var string
     */
    final public const RELATION_USERS = 'users';

    #endregion

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function toOption(): OptionData
    {
        return new OptionData(
            label: $this->{self::LABEL},
            value: $this->{self::ID},
        )
            ->identifier($this->{self::ATTRIBUTE_IDENTIFIER})
            ->name($this->{self::NAME});
    }

    #region • RELATIONSHIPS

    /**
     * Get the associated permissions.
     *
     * @return BelongsToMany
     */
    final public function permissions(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Relation::getMorphedModel(Permission::TABLE),
                RolePermission::TABLE,
                RolePermission::ROLE_ID,
                RolePermission::PERMISSION_ID,
            )
            ->using(RolePermission::class);
    }

    /**
     * Get the associated users.
     *
     * @return BelongsToMany
     */
    final public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Relation::getMorphedModel(User::TABLE),
                UserRole::TABLE,
                UserRole::ROLE_ID,
                UserRole::USER_ID,
            )
            ->using(UserRole::class);
    }

    #endregion

    #endregion
}

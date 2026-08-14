<?php

namespace Narsil\Base\Models\Users;

#region USE

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Narsil\Base\Database\Factories\TanStackTableFactory;
use Narsil\Base\Models\User;
use Narsil\Base\Traits\HasUuidPrimaryKey;

#endregion

#[UseFactory(TanStackTableFactory::class)]
class TanStackTable extends Model
{
    use HasFactory;
    use HasUuidPrimaryKey;

    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;

        $this->mergeCasts([
            self::COLUMN_FILTERS => 'array',
            self::COLUMN_ORDER => 'array',
            self::COLUMN_VISIBILITY => 'array',
            self::ROW_SELECTION => 'array',
            self::SORTING => 'array',
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
    final public const TABLE = 'tan_stack_tables';

    #region • COLUMNS

    /**
     * The name of the "column filters" column.
     *
     * @var string
     */
    final public const COLUMN_FILTERS = 'column_filters';

    /**
     * The name of the "column order" column.
     *
     * @var string
     */
    final public const COLUMN_ORDER = 'column_order';

    /**
     * The name of the "column visibility" column.
     *
     * @var string
     */
    final public const COLUMN_VISIBILITY = 'column_visibility';

    /**
     * The name of the "global filter" column.
     *
     * @var string
     */
    final public const GLOBAL_FILTER = 'global_filter';

    /**
     * The name of the "master uuid" column.
     *
     * @var string
     */
    final public const MASTER_UUID = 'master_uuid';

    /**
     * The name of the "name" column.
     *
     * @var string
     */
    final public const NAME = 'name';

    /**
     * The name of the "page size" column.
     *
     * @var string
     */
    final public const PAGE_SIZE = 'page_size';

    /**
     * The name of the "preset uuid" column.
     *
     * @var string
     */
    final public const PRESET_UUID = 'preset_uuid';

    /**
     * The name of the "row selection" column.
     *
     * @var string
     */
    final public const ROW_SELECTION = 'row_selection';

    /**
     * The name of the "sorting" column.
     *
     * @var string
     */
    final public const SORTING = 'sorting';

    /**
     * The name of the "table name" column.
     *
     * @var string
     */
    final public const TABLE_NAME = 'table_name';

    /**
     * The name of the "user id" column.
     *
     * @var string
     */
    final public const USER_ID = 'user_id';

    #endregion

    #region • RELATIONS

    /**
     * The name of the "master" relation.
     *
     * @var string
     */
    final public const RELATION_MASTER = 'master';

    /**
     * The name of the "preset" relation.
     *
     * @var string
     */
    final public const RELATION_PRESET = 'preset';

    /**
     * The name of the "user" relation.
     *
     * @var string
     */
    final public const RELATION_USER = 'user';

    #endregion

    #endregion

    #region PUBLIC METHODS

    #region • RELATIONSHIPS

    /**
     * Get the associated master.
     *
     * @return BelongsTo
     */
    final public function master(): BelongsTo
    {
        return $this
            ->belongsTo(
                TanStackTable::class,
                self::MASTER_UUID,
                TanStackTable::UUID,
            );
    }

    /**
     * Get the associated preset.
     *
     * @return BelongsTo
     */
    final public function preset(): BelongsTo
    {
        return $this
            ->belongsTo(
                TanStackTable::class,
                self::PRESET_UUID,
                TanStackTable::UUID,
            );
    }

    /**
     * Get the associated user.
     *
     * @return BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this
            ->belongsTo(
                Relation::getMorphedModel(User::TABLE),
                self::USER_ID,
                User::class,
            );
    }

    #endregion

    #endregion

    #region PROTECTED METHODS

    #region • ACCESSORS

    /**
     * Get the "name" attribute.
     *
     * @return string
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value)
            {
                return $value ?? trans('narsil::ui.default');
            },
        );
    }

    #endregion

    #endregion
}

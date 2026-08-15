<?php

namespace Narsil\Base\Http\Data;

#region USE

use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

#endregion

/**
 * @property string $name The name of the column.
 * @property string $type The type of the column.
 */
class ColumnData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $name
     * @param string $type
     *
     * @return void
     */
    public function __construct(string $name, string $type)
    {
        $this->set('name', $name);
        $this->set('type', $type);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param array $column
     *
     * @return ColumnData
     */
    public static function fromSchema(array $column): ColumnData
    {
        return new ColumnData(
            name: Arr::get($column, 'name', ''),
            type: Arr::get($column, 'type_name', ''),
        );
    }

    #endregion
}

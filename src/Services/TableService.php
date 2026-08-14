<?php

namespace Narsil\Base\Services;

#region USE

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Http\Data\ColumnData;

#endregion

abstract class TableService
{
    #region PUBLIC METHODS

    /**
     * Get the data of the columns of a table.
     *
     * @param string $table
     *
     * @return Collection<string,ColumnData>
     */
    public static function getColumns(string $table): Collection
    {
        return Cache::rememberForever("$table-columns", function () use ($table)
        {
            $columns = Schema::getColumns($table);

            return collect($columns)->mapWithKeys(function ($column)
            {
                $column = ColumnData::fromSchema($column);

                return [
                    $column->name => $column,
                ];
            });
        });
    }

    #endregion
}

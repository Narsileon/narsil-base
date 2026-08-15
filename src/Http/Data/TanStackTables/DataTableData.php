<?php

namespace Narsil\Base\Http\Data\TanStackTables;

#region USE

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Fluent;
use Narsil\Base\Enums\OperatorEnum;
use Narsil\Base\Enums\PostgreTypeEnum;
use Narsil\Base\Models\Users\TanStackTable;
use Narsil\Base\Services\TableService;

#endregion

/**
 * @property string $table
 * @property string $uuid
 * @property array|null $column_filters The filters of the columns.
 * @property array|null $column_order The order of the columns.
 * @property array|null $column_visibility The visibility of the columns.
 * @property string|null $global_filter The filter of the table.
 * @property integer|null $page_size The size of the table.
 * @property array|null $row_selection The selected rows.
 * @property array|null $sorting The sorted columns.
 */
class DataTableData extends Fluent
{
    #region CONSTRUCTOR

    /**
     * @param string $table
     * @param string $uuid
     * @param array|null $columnFilters
     * @param array|null $columnOrder
     * @param array|null $columnVisibility
     * @param string|null $globalFilter
     * @param integer|null $pageSize
     * @param array|null $rowSelection
     * @param array|null $sorting
     *
     * @return void
     */
    public function __construct(
        string $table = '',
        string $uuid = '',
        ?array $columnFilters = null,
        ?array $columnOrder = null,
        ?array $columnVisibility = null,
        ?string $globalFilter = null,
        ?int $pageSize = null,
        ?array $rowSelection = null,
        ?array $sorting = null
    )
    {
        $this->set('table', $table);

        $this->set(TanStackTable::COLUMN_FILTERS, $columnFilters ?? []);
        $this->set(TanStackTable::COLUMN_ORDER, $columnOrder ?? []);
        $this->set(TanStackTable::COLUMN_VISIBILITY, $columnVisibility ?? []);
        $this->set(TanStackTable::GLOBAL_FILTER, $globalFilter ?? '');
        $this->set(TanStackTable::PAGE_SIZE, $pageSize ?? 10);
        $this->set(TanStackTable::ROW_SELECTION, $rowSelection ?? []);
        $this->set(TanStackTable::SORTING, $sorting ?? []);
        $this->set(TanStackTable::UUID, $uuid);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param TanStackTable $tanStacktable
     *
     * @return DataTableData
     */
    public static function fromModel(TanStackTable $tanStacktable): DataTableData
    {
        return new DataTableData(
            columnFilters: $tanStacktable?->{TanStackTable::COLUMN_FILTERS},
            columnOrder: $tanStacktable?->{TanStackTable::COLUMN_ORDER},
            columnVisibility: $tanStacktable?->{TanStackTable::COLUMN_VISIBILITY},
            globalFilter: $tanStacktable?->{TanStackTable::GLOBAL_FILTER},
            pageSize: $tanStacktable?->{TanStackTable::PAGE_SIZE},
            rowSelection: $tanStacktable?->{TanStackTable::ROW_SELECTION},
            sorting: $tanStacktable?->{TanStackTable::SORTING},
            table: $tanStacktable?->{TanStackTable::TABLE_NAME},
            uuid: $tanStacktable?->{TanStackTable::UUID},
        );
    }

    /**
     * Applies the column filters to the query.
     *
     * @param Builder $query
     *
     * @return void
     */
    public function applyColumnFilters(Builder $query): void
    {
        $locale = App::getLocale();

        $model = $query->getModel();

        foreach ($this->column_filters as $filter)
        {
            $column = Arr::get($filter, 'id');
            $content = json_decode(Arr::get($filter, 'value', ''), true);

            $operator = Arr::get($content, 'operator');
            $value = Arr::get($content, 'value');

            if (empty($column) || empty($operator) || empty($value))
            {
                continue;
            }

            $key = $column;

            if (method_exists($model, 'isTranslatableAttribute') && $model->isTranslatableAttribute($column))
            {
                $key = "$column->$locale";
            }

            match ($operator)
            {
                OperatorEnum::AFTER_OR_EQUAL->value => $query->whereDate($key, '>=', $value),
                OperatorEnum::AFTER->value => $query->whereDate($key, '>', $value),
                OperatorEnum::BEFORE_OR_EQUAL->value => $query->whereDate($key, '<=', $value),
                OperatorEnum::BEFORE->value => $query->whereDate($key, '<', $value),
                OperatorEnum::CONTAINS->value => $query->whereLike($key, "%{$value}%"),
                OperatorEnum::DOESNT_END_WITH->value => $query->whereNotLike($key, "%{$value}"),
                OperatorEnum::DOESNT_START_WITH->value => $query->whereNotLike($key,  "{$value}%"),
                OperatorEnum::ENDS_WITH->value => $query->whereLike($key, "%{$value}"),
                OperatorEnum::EQUALS->value => $query->where($key, '=', $value),
                OperatorEnum::GREATER_THAN_OR_EQUAL->value => $query->where($key, '>=', $value),
                OperatorEnum::GREATER_THAN->value => $query->where($key, '>', $value),
                OperatorEnum::LESS_THAN_OR_EQUAL->value => $query->where($key, '<=', $value),
                OperatorEnum::LESS_THAN->value => $query->where($key, '<', $value),
                OperatorEnum::NOT_CONTAINS->value => $query->whereNotLike($key, "%{$value}%"),
                OperatorEnum::NOT_EQUALS->value => $query->where($key, '!=', $value),
                OperatorEnum::STARTS_WITH->value => $query->whereLike($key, "{$value}%"),
                default => null,
            };
        }
    }

    /**
     * Applies the global filter to the query.
     *
     * @param Builder $query
     *
     * @return void
     */
    public function applyGlobalFilter(Builder $query): void
    {
        if (empty($this->global_filter))
        {
            return;
        }

        $locale = App::getLocale();

        $columns = TableService::getColumns($this->table);

        $columns->each(function ($column) use ($locale, $query)
        {
            switch ($column->type)
            {
                case PostgreTypeEnum::JSONB->value:
                    $query->orWhereLike("$column->name->$locale", '%' . $this->global_filter . '%');
                    break;
                case PostgreTypeEnum::VARCHAR->value:
                    $query->orWhereLike($column->name, '%' . $this->global_filter . '%');
                    break;
                default:
                    break;
            }
        });
    }

    /**
     * Applies the sorting to the query.
     *
     * @param Builder $query
     *
     * @return void
     */
    public function applySorting(Builder $query): void
    {
        if (empty($this->sorting))
        {
            return;
        }

        foreach ($this->sorting as $sorting)
        {
            $id = Arr::get($sorting, 'id');
            $desc = Arr::get($sorting, 'desc');

            $query->orderBy($id, $desc ? 'desc' : 'asc');
        }
    }

    #endregion
}

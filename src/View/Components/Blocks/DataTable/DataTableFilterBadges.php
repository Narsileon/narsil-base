<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableFilterBadges extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $payload
     *
     * @return void
     */
    public function __construct(
        mixed $payload
    )
    {
        $this->payload = $payload;
        $this->activeFilters = $this->resolveActiveFilters($payload);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $activeFilters;

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-filter-badges');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $column
     *
     * @return array<string,mixed>
     */
    private function normalizeColumn(mixed $column): array
    {
        if (is_object($column) && method_exists($column, 'toArray'))
        {
            return $column->toArray();
        }

        return (array) $column;
    }

    /**
     * Return the currently applied column filters.
     *
     * @param mixed $payload
     *
     * @return array<int,array<string,mixed>>
     */
    private function resolveActiveFilters(mixed $payload): array
    {
        $meta = Arr::get($payload, 'meta', []);
        $columns = collect(Arr::get($meta, 'columns', []))->keyBy(
            function ($column): string
            {
                $column = $this->normalizeColumn($column);

                return (string) Arr::get($column, 'id');
            },
        );
        $filters = Arr::get($meta, 'state.column_filters', []);

        return collect($filters)->map(
            function ($filter, $index) use ($columns): ?array
            {
                $content = Arr::get($filter, 'value', []);

                if (is_string($content))
                {
                    $content = json_decode($content, true) ?: [];
                }

                $columnId = (string) Arr::get($filter, 'id');
                $operator = (string) Arr::get($content, 'operator');
                $value = (string) Arr::get($content, 'value');
                $column = $columns->get($columnId);

                if (!$column || $operator === '' || $value === '')
                {
                    return null;
                }

                return [
                    'column' => ucfirst((string) Arr::get($column, 'header', $columnId)),
                    'column_id' => $columnId,
                    'index' => (int) $index,
                    'operator' => trans('narsil::operators.' . $operator),
                    'operator_value' => $operator,
                    'value' => $value,
                ];
            },
        )->filter()->values()->all();
    }

    #endregion
}

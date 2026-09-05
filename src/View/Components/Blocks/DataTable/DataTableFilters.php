<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DataTableFilters extends Component
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
		$this->activeFilters = $this->resolveActiveFilters();
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

	/**
	 * @var array<int,array<string,string>>
	 */
	public readonly array $activeFilters;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-filters');
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Return the currently applied column filters.
     *
     * @return array<int,array<string,string>>
     */
    protected function resolveActiveFilters(): array
    {
        $meta = data_get($this->payload, 'meta', []);
        $columns = collect(data_get($meta, 'columns', []))->keyBy(
            function ($column): string
            {
                return (string) data_get($column, 'id');
            },
        );
        $filters = data_get(data_get($meta, 'state', []), 'column_filters', []);

        return collect($filters)->map(
            function ($filter, $index) use ($columns): ?array
            {
                $content = data_get($filter, 'value', []);

                if (is_string($content))
                {
                    $content = json_decode($content, true) ?: [];
                }

                $columnId = (string) data_get($filter, 'id');
                $operator = (string) data_get($content, 'operator');
                $value = (string) data_get($content, 'value');
                $column = $columns->get($columnId);

                if (!$column || $operator === '' || $value === '')
                {
                    return null;
                }

                $query = request()->query();
                unset($query['column_filters'][$index]);

                if (isset($query['column_filters']) && $query['column_filters'] === [])
                {
                    unset($query['column_filters']);
                }

                $removeUrl = request()->url();
                $queryString = http_build_query($query);

                if ($queryString !== '')
                {
                    $removeUrl .= '?' . $queryString;
                }

                return [
                    'column' => ucfirst((string) data_get($column, 'header', $columnId)),
                    'operator' => trans('narsil::operators.' . $operator),
                    'value' => $value,
                    'remove_url' => $removeUrl,
                ];
            },
        )->filter()->values()->all();
    }

    #endregion
}

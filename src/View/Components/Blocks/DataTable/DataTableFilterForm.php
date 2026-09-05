<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableFilterForm extends Component
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
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    #endregion

    #region PUBLIC METHODS

    /**
     * Return the available column filter options.
     *
     * @return array<int,array<string,string>>
     */
    public function columnOptions(): array
    {
        return collect(Arr::get($this->payload, 'meta.columns', []))
            ->map(function ($column): array
            {
                $column = $this->normalizeColumn($column);
                $header = Arr::get($column, 'header');

                if ($header === null)
                {
                    $header = Arr::get($column, 'id');
                }

                return [
                    'label' => ucfirst((string) $header),
                    'value' => (string) Arr::get($column, 'id'),
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Return the available filter operator options.
     *
     * @return array<int,array<string,string>>
     */
    public function operatorOptions(): array
    {
        return collect(['contains', 'equals', 'starts_with', 'ends_with'])
            ->map(function (string $operator): array
            {
                return [
                    'label' => trans('narsil::operators.' . $operator),
                    'value' => $operator,
                ];
            })
            ->all();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-filter-form');
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

    #endregion
}

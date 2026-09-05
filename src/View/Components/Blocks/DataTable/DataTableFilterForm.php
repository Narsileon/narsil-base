<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
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
        return collect(data_get(data_get($this->payload, 'meta', []), 'columns', []))
            ->map(function ($column): array
            {
                return [
                    'label' => ucfirst(data_get($column, 'header', data_get($column, 'id'))),
                    'value' => (string) data_get($column, 'id'),
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
}

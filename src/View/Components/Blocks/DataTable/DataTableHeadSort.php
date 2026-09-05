<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableHeadSort extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $column
     * @param mixed $payload
     *
     * @return void
     */
    public function __construct(
        mixed $column,
        mixed $payload
    )
    {
        $this->payload = $payload;
        $this->column = $column;
        $this->current = $this->resolveCurrent($column, $payload);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $column;

    /**
     * @var mixed
     */
    public readonly mixed $payload;

    /**
     * @var mixed
     */
    public readonly mixed $current;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-head-sort');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $column
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveCurrent(mixed $column, mixed $payload): mixed
    {
        $state = Arr::get($payload, 'meta.state', []);

        if (is_object($state) && method_exists($state, 'toArray'))
        {
            $state = $state->toArray();
        }
        else
        {
            $state = (array) $state;
        }

        return collect(Arr::get($state, 'sorting', []))->firstWhere('id', $column['id']);
    }

    #endregion
}

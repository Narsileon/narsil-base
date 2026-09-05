<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableColumnsItem extends Component
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
        $this->column = $column;
        $this->payload = $payload;
        $this->visible = $this->resolveVisible($payload);
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
    public readonly mixed $visible;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-columns-item');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $payload
     *
     * @return mixed
     */
    private function resolveVisible(mixed $payload): mixed
    {
        return Arr::get($payload, 'meta.state.column_visibility', []);
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
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
        $this->column = $column;
        $this->payload = $payload;
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
}

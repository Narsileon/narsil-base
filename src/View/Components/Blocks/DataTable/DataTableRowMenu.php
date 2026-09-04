<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DataTableRowMenu extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $routes
     * @param mixed $id
     * @param mixed $parameters
     *
     * @return void
     */
    public function __construct(
        mixed $routes,
        mixed $id,
        mixed $parameters = []
    )
    {
        $this->routes = $routes;
        $this->id = $id;
        $this->parameters = $parameters;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $parameters;

    /**
     * @var mixed
     */
    public readonly mixed $routes;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-row-menu');
    }

    #endregion
}

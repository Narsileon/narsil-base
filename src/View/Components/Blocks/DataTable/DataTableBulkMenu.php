<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class DataTableBulkMenu extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $routes
     * @param mixed $parameters
     *
     * @return void
     */
    public function __construct(
        mixed $routes,
        mixed $parameters = []
    )
    {
        $this->destroyUrl = $this->resolveUrl($routes, $parameters, 'destroyMany');
        $this->replicateUrl = $this->resolveUrl($routes, $parameters, 'replicateMany');
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $destroyUrl;

    /**
     * @var mixed
     */
    public readonly mixed $replicateUrl;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.data-table.data-table-bulk-menu');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $routes
     * @param mixed $parameters
     * @param string $routeKey
     *
     * @return mixed
     */
    private function resolveUrl(mixed $routes, mixed $parameters, string $routeKey): mixed
    {
        $route = Arr::get($routes, $routeKey);
        $url = null;

        if ($route)
        {
            $url = route($route, $parameters);
        }

        return $url;
    }

    #endregion
}

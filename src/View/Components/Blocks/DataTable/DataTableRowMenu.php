<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\DataTable;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
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
        $this->destroyUrl = $this->resolveUrl($routes, $parameters, $id, 'destroy');
        $this->editUrl = $this->resolveUrl($routes, $parameters, $id, 'edit');
        $this->id = $id;
        $this->parameters = $parameters;
        $this->replicateUrl = $this->resolveUrl($routes, $parameters, $id, 'replicate');
        $this->routes = $routes;
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

    /**
     * @var mixed
     */
    public readonly mixed $destroyUrl;

    /**
     * @var mixed
     */
    public readonly mixed $replicateUrl;

    /**
     * @var mixed
     */
    public readonly mixed $editUrl;

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

    #region PRIVATE METHODS

    /**
     * @param mixed $routes
     * @param mixed $parameters
     * @param mixed $id
     * @param string $routeKey
     *
     * @return mixed
     */
    private function resolveUrl(mixed $routes, mixed $parameters, mixed $id, string $routeKey): mixed
    {
        $routeParameters = [...$parameters, Arr::get($routes, 'parameter', 'id') => $id];
        $route = Arr::get($routes, $routeKey);
        $url = null;

        if ($route)
        {
            $url = route($route, $routeParameters);
        }

        return $url;
    }

    #endregion
}

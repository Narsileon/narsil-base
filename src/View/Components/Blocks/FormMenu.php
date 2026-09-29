<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\Component;

#endregion

final class FormMenu extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $routes
     * @param mixed $id
     * @param boolean $actionsOnly
     *
     * @return void
     */
    public function __construct(mixed $routes = [], mixed $id = null, bool $actionsOnly = false)
    {
        $this->actionsOnly = $actionsOnly;
        $this->deleteUrl = $this->resolveUrl($routes, $id, 'destroy');
        $this->unpublishUrl = $this->resolveUrl($routes, $id, 'unpublish');
        $this->hasActions = $this->deleteUrl !== null || $this->unpublishUrl !== null;
        $this->unpublishFormId = $this->getUnpublishFormId($this->unpublishUrl);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $actionsOnly;

    /**
     * @var string|null
     */
    public readonly ?string $deleteUrl;

    /**
     * @var boolean
     */
    public readonly bool $hasActions;

    /**
     * @var string|null
     */
    public readonly ?string $unpublishFormId;

    /**
     * @var string|null
     */
    public readonly ?string $unpublishUrl;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.form-menu.root');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string|null $url
     *
     * @return string|null
     */
    private function getUnpublishFormId(?string $url): ?string
    {
        $id = null;

        if ($url)
        {
            $id = 'narsil-unpublish-' . Str::substr(sha1($url), 0, 12);
        }

        return $id;
    }

    /**
     * @param mixed $routes
     * @param mixed $id
     * @param string $key
     *
     * @return string|null
     */
    private function resolveUrl(mixed $routes, mixed $id, string $key): ?string
    {
        $routeData = (array) $routes;
        $routeName = Arr::get($routeData, $key);
        $url = null;

        if ($routeName && $id !== null && $id !== '')
        {
            $parameters = Arr::wrap(Arr::get($routeData, 'parameters', []));
            $parameter = Arr::get($routeData, 'parameter', 'id');
            $parameters[$parameter] = $id;

            $url = URL::route($routeName, $parameters);
        }

        return $url;
    }

    #endregion
}

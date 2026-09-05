<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

#endregion

final class FormSave extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $formId
     * @param mixed $hasModel
     * @param mixed $routes
     * @param mixed $submitLabel
     *
     * @return void
     */
    public function __construct(
        mixed $formId = 'form',
        mixed $hasModel = false,
        mixed $routes = [],
        mixed $submitLabel = null
    )
    {
        $this->createUrl = $this->resolveUrl($routes, 'create');
        $this->formId = (string) $formId;
        $this->hasModel = (bool) $hasModel;
        $this->publish = (bool) Arr::get($routes, 'unpublish');
        $this->saveAsNewUrl = $this->hasModel ? $this->resolveUrl($routes, 'store') : null;
        $this->submitLabel = (string) ($submitLabel ?: trans('narsil::ui.save'));
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public readonly ?string $createUrl;

    /**
     * @var string
     */
    public readonly string $formId;

    /**
     * @var boolean
     */
    public readonly bool $hasModel;

    /**
     * @var boolean
     */
    public readonly bool $publish;

    /**
     * @var string|null
     */
    public readonly ?string $saveAsNewUrl;

    /**
     * @var string
     */
    public readonly string $submitLabel;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-save');
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param mixed $routes
     * @param string $routeKey
     *
     * @return string|null
     */
    private function resolveUrl(mixed $routes, string $routeKey): ?string
    {
        $route = Arr::get($routes, $routeKey);
        $parameters = Arr::get($routes, 'parameters', []);
        $url = null;

        if ($route)
        {
            $url = route($route, is_array($parameters) ? $parameters : []);
        }

        return $url;
    }

    #endregion
}

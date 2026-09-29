<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers;

#region USE

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;

#endregion

abstract class RenderController
{
    use AuthorizesRequests;

    #region CONSTANTS

    /**
     * The name of the "description" prop.
     *
     * @var string
     */
    final protected const DESCRIPTION = 'description';

    /**
     * The name of the "title" prop.
     *
     * @var string
     */
    final protected const TITLE = 'title';

    #endregion

    #region PROTECTED METHODS

    /**
     * @return string
     */
    abstract protected function getDescription(): string;

    /**
     * @return string
     */
    abstract protected function getTitle(): string;

    /**
     * @param string $view
     * @param array $props
     *
     * @return View
     */
    protected function renderBlade(string $view, array $props = []): View
    {
        return view($view, [
            self::DESCRIPTION => $this->getDescription(),
            self::TITLE => $this->getTitle(),
            ...$props,
        ]);
    }

    #endregion
}

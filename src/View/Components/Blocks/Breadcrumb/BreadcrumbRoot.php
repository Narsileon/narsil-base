<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Breadcrumb;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class BreadcrumbRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $breadcrumb
     *
     * @return void
     */
    public function __construct(
        mixed $breadcrumb = []
    )
    {
        $this->breadcrumb = $breadcrumb;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $breadcrumb;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.breadcrumb.breadcrumb-root');
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Container;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ContainerRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $variant = 'md'
    )
    {
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.container.container-root');
    }

    #endregion
}

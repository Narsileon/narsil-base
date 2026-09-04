<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Logo;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class LogoRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $showName
     *
     * @return void
     */
    public function __construct(
        mixed $showName = true
    )
    {
        $this->showName = $showName;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $showName;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.logo.logo-root');
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Heading;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class HeadingRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $level
     * @param mixed $variant
     *
     * @return void
     */
    public function __construct(
        mixed $level = 'h1',
        mixed $variant = 'h6'
    )
    {
        $this->level = $level;
        $this->variant = $variant;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $level;

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
        return view('narsil::components.ui.heading.heading-root');
    }

    #endregion
}

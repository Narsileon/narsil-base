<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Accordion;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AccordionRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $defaultValue
     * @param mixed $multiple
     *
     * @return void
     */
    public function __construct(
        mixed $defaultValue = null,
        mixed $multiple = false
    )
    {
        $this->defaultValue = $defaultValue;
        $this->multiple = $multiple;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $defaultValue;

    /**
     * @var mixed
     */
    public readonly mixed $multiple;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.accordion.accordion-root');
    }

    #endregion
}

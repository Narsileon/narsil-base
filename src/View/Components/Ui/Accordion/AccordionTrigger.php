<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Accordion;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class AccordionTrigger extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $value
    )
    {
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $value;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.accordion.accordion-trigger');
    }

    #endregion
}

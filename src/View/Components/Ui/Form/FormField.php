<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormField extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $orientation
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $orientation = 'vertical'
    )
    {
        $this->element = $element;
        $this->orientation = $orientation;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $element;

    /**
     * @var mixed
     */
    public readonly mixed $orientation;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-field');
    }

    #endregion
}

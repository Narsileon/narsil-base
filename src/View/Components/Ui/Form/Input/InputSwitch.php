<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputSwitch extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $id
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $id,
        mixed $value = false
    )
    {
        $this->element = $element;
        $this->id = $id;
        $this->value = $value;
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
    public readonly mixed $id;

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
        return view('narsil::components.ui.form.input.input-switch');
    }

    #endregion
}

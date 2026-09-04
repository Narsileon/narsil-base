<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Inputs;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputsSelect extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $id
     * @param mixed $element
     * @param mixed $input
     * @param mixed $model
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $id,
        mixed $element = null,
        mixed $input = null,
        mixed $model = null,
        mixed $value = null
    )
    {
        $this->id = $id;
        $this->element = $element;
        $this->input = $input;
        $this->model = $model;
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
    public readonly mixed $input;

    /**
     * @var mixed
     */
    public readonly mixed $model;

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
        return view('narsil::components.ui.form.inputs.inputs-select');
    }

    #endregion
}

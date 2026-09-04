<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Inputs;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputsFile extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $input
     * @param mixed $id
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $input,
        mixed $id
    )
    {
        $this->element = $element;
        $this->input = $input;
        $this->id = $id;
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

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.inputs.inputs-file');
    }

    #endregion
}

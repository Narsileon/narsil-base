<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class DynamicForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $form
     * @param mixed $values
     *
     * @return void
     */
    public function __construct(
        mixed $form,
        mixed $values = []
    )
    {
        $this->form = $form;
        $this->values = $values;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $form;

    /**
     * @var mixed
     */
    public readonly mixed $values;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.dynamic-form');
    }

    #endregion
}

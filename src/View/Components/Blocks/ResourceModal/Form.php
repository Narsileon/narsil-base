<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\ResourceModal;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class Form extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $form
     *
     * @return void
     */
    public function __construct(
        mixed $form = null,
    )
    {
        $this->form = $form;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $form;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.resource-modal.form');
    }

    #endregion
}

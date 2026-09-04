<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Combobox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ComboboxTrigger extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $disabled
     * @param mixed $id
     * @param mixed $required
     *
     * @return void
     */
    public function __construct(
        mixed $disabled = false,
        mixed $id = null,
        mixed $required = false
    )
    {
        $this->disabled = $disabled;
        $this->id = $id;
        $this->required = $required;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $disabled;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $required;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.combobox.combobox-trigger');
    }

    #endregion
}

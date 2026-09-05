<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Checkbox;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CheckboxRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $name
     * @param mixed $checked
     * @param mixed $disabled
     * @param mixed $required
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $name = null,
        mixed $checked = false,
        mixed $disabled = false,
        mixed $required = false,
        mixed $value = '1'
    )
    {
        $this->name = $name;
        $this->checked = $checked;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $checked;

    /**
     * @var mixed
     */
    public readonly mixed $disabled;

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var mixed
     */
    public readonly mixed $required;

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
        return view('narsil::components.blocks.checkbox.checkbox-root');
    }

    #endregion
}

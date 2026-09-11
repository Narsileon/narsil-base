<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputCheckbox extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $id
     * @param mixed $input
     * @param mixed $name
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $id,
        mixed $input,
        mixed $name = null,
        mixed $value = false
    )
    {
        $this->element = $element;
        $this->id = $id;
        $this->input = $input;
        $this->name = $name ?? (string) $id;
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
     * @var string
     */
    public readonly string $name;

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
        return view('narsil::components.blocks.input.input-checkbox');
    }

    #endregion
}

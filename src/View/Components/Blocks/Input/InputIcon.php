<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Narsil\Base\View\Components\Ui\Icon\IconRoot;

#endregion

final class InputIcon extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $id
     * @param mixed $input
     * @param mixed $value
     * @param mixed $name
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $id,
        mixed $input,
        mixed $value = null,
        mixed $name = null
    )
    {
        $this->element = $element;
        $this->id = $id;
        $this->input = $input;
        $this->name = $name ?? (string) $id;
        $this->options = IconRoot::getOptions();
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
     * @var array<int,array<string,string>>
     */
    public readonly array $options;

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
        return view('narsil::components.blocks.input.input-icon');
    }

    #endregion
}

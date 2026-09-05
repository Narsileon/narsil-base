<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputSelect extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $id
     * @param mixed $element
     * @param mixed $input
     * @param mixed $model
     * @param boolean $translatable
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $id,
        mixed $element = null,
        mixed $input = null,
        mixed $model = null,
        bool $translatable = false,
        mixed $value = null
    )
    {
        $this->id = $id;
        $this->element = $element;
        $this->input = $input;
        $this->model = $model;
        $name = (string) $id;

        if ($translatable)
        {
            $name = null;
        }

        $this->name = $name;
        $this->translatable = $translatable;
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
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * @var boolean
     */
    public readonly bool $translatable;

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
        return view('narsil::components.ui.form.input.input-select');
    }

    #endregion
}

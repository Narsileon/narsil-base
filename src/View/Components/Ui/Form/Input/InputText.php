<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form\Input;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class InputText extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $input
     * @param mixed $id
     * @param boolean $translatable
     * @param mixed $type
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $input,
        mixed $id,
        bool $translatable = false,
        mixed $type = 'text',
        mixed $value = ''
    )
    {
        $this->element = $element;
        $this->input = $input;
        $this->id = $id;
        $name = (string) $id;

        if ($translatable)
        {
            $name = null;
        }

        $this->name = $name;
        $this->translatable = $translatable;
        $this->type = $type;
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
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * @var mixed
     */
    public readonly mixed $input;

    /**
     * @var mixed
     */
    public readonly mixed $type;

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
        return view('narsil::components.ui.form.input.input-text');
    }

    #endregion
}

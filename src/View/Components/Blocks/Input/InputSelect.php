<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\Input;

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
     * @param mixed $name
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
        mixed $name = null,
        bool $translatable = false,
        mixed $value = null
    ) {
        $this->clearable = (bool) data_get($input, 'clearable', false);
        $this->clearOnReload = data_get($input, 'clearOnReload', []);
        $this->id = $id;
        $this->model = $model;
        $this->multiple = (bool) data_get($input, 'multiple', false);
        $name = $name ?? (string) $id;

        if ($translatable)
        {
            $name = null;
        }

        $this->name = $name;
        $this->options = data_get($input, 'options', []);
        $this->placeholder = data_get($input, 'placeholder');
        $this->reload = data_get($input, 'reload');
        $this->renderLabel = (bool) data_get($input, 'renderLabel', false);
        $this->required = (bool) data_get($element, 'required', false);
        $this->translatable = $translatable;
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var boolean
     */
    public readonly bool $clearable;

    /**
     * @var array<int,string>
     */
    public readonly array $clearOnReload;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $model;

    /**
     * @var boolean
     */
    public readonly bool $multiple;

    /**
     * @var string|null
     */
    public readonly ?string $name;

    /**
     * @var array<int,mixed>
     */
    public readonly array $options;

    /**
     * @var string|null
     */
    public readonly ?string $placeholder;

    /**
     * @var string|null
     */
    public readonly ?string $reload;

    /**
     * @var boolean
     */
    public readonly bool $renderLabel;

    /**
     * @var boolean
     */
    public readonly bool $required;

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
        return view('narsil::components.blocks.input.input-select');
    }

    #endregion
}

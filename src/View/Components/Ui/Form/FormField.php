<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormField extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $element
     * @param mixed $orientation
     * @param boolean $translatable
     * @param array<string,mixed> $translationValues
     * @param mixed $id
     * @param mixed $name
     * @param string|null $model
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $orientation = 'vertical',
        bool $translatable = false,
        array $translationValues = [],
        mixed $id = null,
        mixed $name = null,
        ?string $model = null
    ) {
        $this->element = $element;
        $this->orientation = $orientation;
        $errorKey = (string) ($id ?? $name);

        if ($model)
        {
            $errorKey = $model . '.' . $errorKey;
        }

        $this->errorKey = $errorKey;
        $this->state = 'narsilFormField(' . json_encode([
            'fieldLanguage' => app()->getLocale(),
            'livewireField' => (string) ($id ?? $name),
            'livewireTranslatable' => $translatable,
            'translationValues' => $translationValues,
        ]) . ')';
        $this->id = $id;
        $this->name = $name;
        $this->translatable = $translatable;
        $this->translationValues = $translationValues;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $element;

    /**
     * @var string
     */
    public readonly string $errorKey;

    /**
     * @var mixed
     */
    public readonly mixed $id;

    /**
     * @var mixed
     */
    public readonly mixed $name;

    /**
     * @var mixed
     */
    public readonly mixed $orientation;

    /**
     * @var string
     */
    public readonly string $state;

    /**
     * @var boolean
     */
    public readonly bool $translatable;

    /**
     * @var array<string,mixed>
     */
    public readonly array $translationValues;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-field');
    }

    #endregion
}

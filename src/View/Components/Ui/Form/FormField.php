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
     *
     * @return void
     */
    public function __construct(
        mixed $element,
        mixed $orientation = 'vertical',
        bool $translatable = false,
        array $translationValues = []
    )
    {
        $this->element = $element;
        $this->orientation = $orientation;
        $this->state = sprintf(
            '{ fieldLanguage: typeof formLanguage !== "undefined" ? formLanguage : %s, translationValues: %s }',
            json_encode(app()->getLocale()),
            json_encode($translationValues),
        );
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

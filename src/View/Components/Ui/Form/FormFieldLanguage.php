<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormFieldLanguage extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $languages
     * @param mixed $value
     *
     * @return void
     */
    public function __construct(
        mixed $languages = [],
        mixed $value = null
    )
    {
        $this->languages = $languages;
        $this->value = $value;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $languages;

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
        return view('narsil::components.ui.form.form-field-language');
    }

    #endregion
}

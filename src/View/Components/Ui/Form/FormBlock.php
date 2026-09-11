<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormBlock extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $baseId
     * @param mixed $fieldset
     * @param mixed $formData
     * @param mixed $languages
     *
     * @return void
     */
    public function __construct(
        mixed $baseId = null,
        mixed $fieldset = null,
        mixed $formData = null,
        mixed $languages = null,
    )
    {
        $this->baseId = $baseId;
        $this->fieldset = $fieldset;
        $this->formData = $formData;
        $this->languages = $languages;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $baseId;

    /**
     * @var mixed
     */
    public readonly mixed $fieldset;

    /**
     * @var mixed
     */
    public readonly mixed $formData;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-block');
    }

    #endregion
}

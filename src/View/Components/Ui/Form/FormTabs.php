<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormTabs extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $formData
     * @param mixed $languages
     * @param mixed $sidebar
     * @param mixed $steps
     * @param mixed $defaultLanguage
     *
     * @return void
     */
    public function __construct(
        mixed $formData = [],
        mixed $languages = [],
        mixed $steps = [],
        mixed $sidebar = null,
        mixed $defaultLanguage = null
    )
    {
        $this->defaultLanguage = $defaultLanguage;
        $this->formData = $formData;
        $this->languages = $languages;
        $this->sidebar = $sidebar;
        $this->steps = $steps;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $defaultLanguage;

    /**
     * @var mixed
     */
    public readonly mixed $formData;

    /**
     * @var mixed
     */
    public readonly mixed $languages;

    /**
     * @var mixed
     */
    public readonly mixed $sidebar;

    /**
     * @var mixed
     */
    public readonly mixed $steps;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-tabs');
    }

    #endregion
}

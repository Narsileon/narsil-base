<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Ui\Form;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FormProvider extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $defaultLanguage
     * @param mixed $languages
     *
     * @return void
     */
    public function __construct(
        mixed $defaultLanguage = 'en',
        mixed $languages = []
    )
    {
        $this->defaultLanguage = $defaultLanguage;
        $this->languages = $languages;
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
    public readonly mixed $languages;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.ui.form.form-provider');
    }

    #endregion
}

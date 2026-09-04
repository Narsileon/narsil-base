<?php

declare(strict_types=1);

namespace Narsil\Base\View\Components\Blocks\UserSettings;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class UserSettingsForm extends Component
{
    #region CONSTRUCTOR

    /**
     * @param mixed $form
     * @param mixed $showSubmit
     * @param mixed $values
     *
     * @return void
     */
    public function __construct(
        mixed $form,
        mixed $showSubmit = true,
        mixed $values = []
    )
    {
        $this->form = $form;
        $this->showSubmit = $showSubmit;
        $this->values = $values;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var mixed
     */
    public readonly mixed $form;

    /**
     * @var mixed
     */
    public readonly mixed $showSubmit;

    /**
     * @var mixed
     */
    public readonly mixed $values;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('narsil::components.blocks.user-settings.user-settings-form');
    }

    #endregion
}

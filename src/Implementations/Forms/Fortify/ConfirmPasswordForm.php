<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\ConfirmPasswordForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class ConfirmPasswordForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('confirm-password-form')
            ->action(route('password.confirm'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.confirm'));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        id: User::PASSWORD,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::ONE_TIME_CODE->value,
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

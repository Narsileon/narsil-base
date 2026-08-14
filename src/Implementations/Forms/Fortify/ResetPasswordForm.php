<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\ResetPasswordForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class ResetPasswordForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('reset-password-form')
            ->action(route('password.update'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.reset'));
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
                        id: User::EMAIL,
                        icon: 'email',
                        required: true,
                        input: new EmailInputData(),
                    ),
                    new FieldData(
                        id: User::PASSWORD,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value
                        ),
                    ),
                    new FieldData(
                        id: User::ATTRIBUTE_PASSWORD_CONFIRMATION,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

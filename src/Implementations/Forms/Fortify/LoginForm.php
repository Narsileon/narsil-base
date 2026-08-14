<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\LoginForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class LoginForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('login-form')
            ->action(route('login'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.log_in'));
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
                        input: new EmailInputData(
                            autoComplete: AutoCompleteEnum::EMAIL->value,
                            placeholder: 'email@example.com',
                        )

                    ),
                    new FieldData(
                        id: User::PASSWORD,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::CURRENT_PASSWORD->value,
                            href: route('password.request'),
                        )
                    ),
                    new FieldData(
                        id: User::REMEMBER,
                        className: 'flex-row-reverse justify-end',
                        input: new CheckboxInputData()
                    ),
                ],
            ),
        ];
    }

    #endregion
}

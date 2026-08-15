<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\RegisterForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class RegisterForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('register-form')
            ->action(route('register'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.register'));
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
                        className: 'col-span-6',
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value,
                        ),
                    ),
                    new FieldData(
                        id: User::ATTRIBUTE_PASSWORD_CONFIRMATION,
                        className: 'col-span-6',
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value,
                        ),
                    ),
                    new FieldData(
                        id: User::FIRST_NAME,
                        className: 'col-span-6',
                        icon: 'circle-user',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::GIVEN_NAME->value,
                        ),
                    ),
                    new FieldData(
                        id: User::LAST_NAME,
                        className: 'col-span-6',
                        icon: 'circle-user',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::FAMILY_NAME->value,
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

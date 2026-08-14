<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\ForgotPasswordForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\EmailInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class ForgotPasswordForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('forgot-password-form')
            ->action(route('password.email'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.send'));
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
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

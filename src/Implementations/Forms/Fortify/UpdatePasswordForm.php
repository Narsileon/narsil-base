<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\UpdatePasswordForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class UpdatePasswordForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('update-password-form')
            ->action(route('user-password.update'))
            ->method(RequestMethodEnum::PUT->value)
            ->submitIcon('save')
            ->submitLabel(trans('narsil::ui.save'));
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
                        id: User::ATTRIBUTE_CURRENT_PASSWORD,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::CURRENT_PASSWORD->value,
                        ),
                    ),
                    new FieldData(
                        id: User::PASSWORD,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value,
                        ),
                    ),
                    new FieldData(
                        id: User::ATTRIBUTE_PASSWORD_CONFIRMATION,
                        required: true,
                        input: new PasswordInputData(
                            autoComplete: AutoCompleteEnum::NEW_PASSWORD->value,
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

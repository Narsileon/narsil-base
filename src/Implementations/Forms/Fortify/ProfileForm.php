<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\ProfileForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\FileInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;

#endregion

class ProfileForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('profile-form')
            ->action(route('user-profile-information.update'))
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
                        id: User::LAST_NAME,
                        icon: 'circle-user',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::FAMILY_NAME->value,
                        ),
                    ),
                    new FieldData(
                        id: User::FIRST_NAME,
                        icon: 'circle-user',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::GIVEN_NAME->value,
                        ),
                    ),
                    new FieldData(
                        id: User::AVATAR,
                        icon: 'image',
                        input: new FileInputData(
                            accept: 'image/*',
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

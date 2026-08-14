<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\TwoFactorChallengeForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;

#endregion

class TwoFactorChallengeForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('two-factor-challenge-form')
            ->action(route('two-factor.login'))
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
                        id: 'code',
                        icon: 'circle-check',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::ONE_TIME_CODE->value,
                        ),
                    ),
                    new FieldData(
                        id: 'recovery_code',
                        icon: 'circle-check',
                        required: true,
                        input: new TextInputData(
                            autoComplete: AutoCompleteEnum::ONE_TIME_CODE->value,
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

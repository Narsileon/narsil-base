<?php

namespace Narsil\Base\Implementations\Forms\Fortify;

#region USE

use Narsil\Base\Contracts\Forms\Fortify\TwoFactorForm as Contract;
use Narsil\Base\Enums\AutoCompleteEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Support\TranslationsBag;

#endregion

class TwoFactorForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this
            ->id('two-factor-form')
            ->action(route('two-factor.confirm'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.confirm'));

        app(TranslationsBag::class)
            ->add('narsil::descriptions.users.code')
            ->add('narsil::descriptions.users.recovery_codes')
            ->add('narsil::ui.recovery_codes')
            ->add('narsil::ui.two_factor');
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
                        description: ModelService::getAttributeDescription(User::TABLE, 'code'),
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

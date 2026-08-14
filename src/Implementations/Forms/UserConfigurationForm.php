<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Narsil\Base\Contracts\Forms\UserConfigurationForm as Contract;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\RangeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Users\UserConfiguration;
use Narsil\Base\Narsil;
use Narsil\Base\Services\LocaleService;

#endregion

/**
 * @author Jonathan Rigaux
 */
class UserConfigurationForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this
            ->action(route('user-configurations.update'))
            ->method(RequestMethodEnum::PUT->value)
            ->submitLabel(trans('narsil::ui.save'));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $languages = app(Narsil::class)->getLocales();

        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        id: UserConfiguration::LANGUAGE,
                        required: true,
                        input: new SelectInputData(
                            defaultValue: App::getLocale(),
                            options: LocaleService::languageOptions($languages),
                        ),
                    ),
                    new FieldData(
                        id: UserConfiguration::COLOR,
                        required: true,
                        input: new SelectInputData(
                            defaultValue: ColorEnum::GRAY->value,
                            options: ColorEnum::options(),
                        ),
                    ),
                    new FieldData(
                        id: UserConfiguration::RADIUS,
                        required: true,
                        input: new RangeInputData(
                            defaultValue: 0.25,
                            max: 1,
                            min: 0,
                            step: 0.05
                        ),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

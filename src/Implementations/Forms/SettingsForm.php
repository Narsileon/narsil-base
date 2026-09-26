<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Narsil\Base\Contracts\Forms\SettingsForm as Contract;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\RangeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Setting;
use Narsil\Base\Narsil;
use Narsil\Base\Services\LocaleService;

#endregion

class SettingsForm extends Form implements Contract
{
    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $backendLanguage = Setting::getValue(Setting::BACKEND_LANGUAGE, app()->getLocale());
        $defaultColor = Setting::getValue(Setting::DEFAULT_COLOR, ColorEnum::GRAY->value);
        $defaultRadius = (float) Setting::getValue(Setting::DEFAULT_RADIUS, 0.25);

        return [
            new FormStepData(
                id: 'configuration',
                label: trans('narsil::ui.configuration'),
                elements: [
                    new FieldData(
                        id: Setting::BACKEND_LANGUAGE,
                        input: new SelectInputData(
                            defaultValue: $backendLanguage,
                            options: LocaleService::languageOptions(app(Narsil::class)->getLocales()),
                        ),
                        label: trans('narsil::ui.default_language'),
                        required: true,
                    ),
                    new FieldData(
                        id: Setting::DEFAULT_COLOR,
                        input: new SelectInputData(
                            defaultValue: $defaultColor,
                            options: ColorEnum::options(),
                            renderLabel: true,
                        ),
                        label: trans('narsil::ui.default_color'),
                        required: true,
                    ),
                    new FieldData(
                        id: Setting::DEFAULT_RADIUS,
                        input: new RangeInputData(
                            defaultValue: $defaultRadius,
                            max: 1,
                            min: 0,
                            step: 0.05,
                        ),
                        label: trans('narsil::ui.default_radius'),
                        required: true,
                    ),
                ],
            ),
        ];
    }

    #endregion
}

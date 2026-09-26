<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Settings;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Narsil\Base\Contracts\Forms\SettingsForm;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Setting;
use Narsil\Base\Services\ModelService;

#endregion

class SettingsEditController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|View
     */
    public function __invoke(Request $request): JsonResponse|View
    {
        $this->authorize(AbilityEnum::UPDATE, new Setting());

        return $this->renderBlade('narsil::pages.resources.form', [
            'data' => Setting::getValues(),
            'form' => $this->getForm(),
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(Setting::TABLE);
    }

    /**
     * @return SettingsForm
     */
    protected function getForm(): SettingsForm
    {
        return app(SettingsForm::class)
            ->action(route('narsil.settings.update'))
            ->id(Setting::TABLE)
            ->method(RequestMethodEnum::PATCH->value)
            ->submitLabel(trans('narsil::ui.update'));
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Setting::TABLE);
    }

    #endregion
}

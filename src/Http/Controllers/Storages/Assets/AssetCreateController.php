<?php

namespace Narsil\Base\Http\Controllers\Storages\Assets;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Contracts\Forms\AssetForm;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Services\ModelService;

#endregion

class AssetCreateController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::CREATE, Asset::class);

        $form = $this->getForm();

        return $this->render('narsil/base::resources/form', [
            'form' => $form,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(Asset::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @return AssetForm
     */
    protected function getForm(): AssetForm
    {
        $form = app(AssetForm::class)
            ->action(route('assets.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Asset::TABLE);
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Services\ModelHookService;
use Narsil\Base\Services\ModelDefinitionService;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelUpdateController extends ModelStoreController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $definition = $this->getDefinition($request);
        $definitionService = app(ModelDefinitionService::class);
        $model = $definitionService->resolveModel(
            $definition,
            $request->route($definitionService->parameter($definition)),
        );

        $this->authorize(AbilityEnum::UPDATE, $model);
        $request->route()->setParameter($definitionService->parameter($definition), $model);

        $attributes = $this->validate($request, $definition->request());
        $context = app(ModelHookService::class)
            ->run($model, ModelHookEventEnum::BEFORE_UPDATE, new ModelHookContext(
                request: $request,
                attributes: $attributes,
                model: $model,
            ));

        $model->update($context->attributes);

        app(ModelHookService::class)
            ->run($model, ModelHookEventEnum::AFTER_UPDATE, new ModelHookContext(
                request: $request,
                attributes: $context->attributes,
                model: $model,
                result: $model,
            ));

        return $this
            ->redirect(route($definition->route() . '.index'), $model)
            ->with('success', ModelService::getSuccessMessage($model->getTable(), ModelEventEnum::UPDATED));
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Http\Requests\DestroyManyRequest;
use Narsil\Base\Services\ModelHookService;
use Narsil\Base\Services\ModelDefinitionService;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelDestroyManyController extends ModelController
{
    #region PUBLIC METHODS

    /**
     * @param DestroyManyRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(DestroyManyRequest $request): RedirectResponse
    {
        $definition = $this->getDefinition($request);
        $definitionService = app(ModelDefinitionService::class);
        $modelClass = $definition->model();
        $model = new $modelClass();

        $this->authorize(AbilityEnum::DELETE_ANY, $modelClass);

        $ids = $request->validated(DestroyManyRequest::IDS);
        $models = $modelClass::query()
            ->whereIn($model->getKeyName(), $ids)
            ->get();

        foreach ($models as $model)
        {
            app(ModelHookService::class)
                ->run($model, ModelHookEventEnum::BEFORE_DESTROY, new ModelHookContext(
                    request: $request,
                    model: $model,
                ));

            $model->delete();

            app(ModelHookService::class)
                ->run($model, ModelHookEventEnum::AFTER_DESTROY, new ModelHookContext(
                    request: $request,
                    model: $model,
                    result: $model,
                ));
        }

        return $this
            ->redirect(route($definition->route() . '.index'))
            ->with('success', ModelService::getSuccessMessage($modelClass::TABLE, ModelEventEnum::DELETED_MANY));
    }

    #endregion
}

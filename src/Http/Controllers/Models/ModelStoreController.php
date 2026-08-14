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
use Narsil\Base\Services\ModelService;

#endregion

class ModelStoreController extends ModelController
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
        $modelClass = $definition->model();

        $this->authorize(AbilityEnum::CREATE, $modelClass);

        $attributes = $this->validate($request, $definition->request());
        $model = new $modelClass();
        $context = app(ModelHookService::class)
            ->run($model, ModelHookEventEnum::BEFORE_STORE, new ModelHookContext(
                request: $request,
                attributes: $attributes,
                model: $model,
            ));

        $model->fill($context->attributes);
        $model->save();

        app(ModelHookService::class)
            ->run($model, ModelHookEventEnum::AFTER_STORE, new ModelHookContext(
                request: $request,
                attributes: $context->attributes,
                model: $model,
                result: $model,
            ));

        return $this
            ->redirect(route($definition->route() . '.index'), $model)
            ->with('success', ModelService::getSuccessMessage($model->getTable(), ModelEventEnum::CREATED));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @param Request $request
     * @param string|null $requestClass
     *
     * @return array<string,mixed>
     */
    protected function validate(Request $request, ?string $requestClass): array
    {
        if (!$requestClass)
        {
            return $request->all();
        }

        $formRequestClass = get_class(app($requestClass));
        $formRequest = $formRequestClass::createFrom($request);
        $formRequest->setContainer(app());
        $formRequest->setRedirector(app('redirect'));
        $formRequest->validateResolved();

        return $formRequest->validated();
    }

    #endregion
}

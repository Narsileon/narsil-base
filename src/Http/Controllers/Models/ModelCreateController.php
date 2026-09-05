<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelCreateController extends ModelRenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response|View
     */
    public function __invoke(Request $request): JsonResponse|Response|View
    {
        $definition = $this->getDefinition($request);
        $this->authorize(AbilityEnum::CREATE, $definition->model());
        $form = $this->getForm($definition->form());

        return $this->renderModelForm($form);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel($this->getTable($this->getDefinition(request())));
    }

    /**
     * @param string|null $formClass
     *
     * @return mixed
     */
    protected function getForm(?string $formClass): mixed
    {
        return app($formClass)
            ->action(route($this->getDefinition(request())->route() . '.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel($this->getTable($this->getDefinition(request())));
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Models;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Collections\DataTableCollection;
use Narsil\Base\Services\ModelService;

#endregion

final class ModelIndexController extends ModelRenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function __invoke(Request $request): JsonResponse|View
    {
        $definition = $this->getDefinition($request);
        $modelClass = $definition->model();

        $this->authorize(AbilityEnum::VIEW_ANY, $modelClass);

        $query = $modelClass::query()
            ->with($definition->indexWith())
            ->withCount($definition->indexWithCount());

        $collection = new DataTableCollection($query, new $modelClass()
            ->getTable());

        return $this->renderBlade('narsil::pages.resources.index', [
            'collection' => $collection,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getTableLabel($this->getTable($this->getDefinition(request())));
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getTableLabel($this->getTable($this->getDefinition(request())));
    }

    #endregion
}

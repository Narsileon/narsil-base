<?php

namespace Narsil\Base\Http\Controllers\Storages\Assets;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Collections\DataTableCollection;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Services\ModelService;

#endregion

class AssetIndexController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::VIEW_ANY, Asset::class);

        $collection = $this->getCollection();

        return $this->render('narsil/base::resources/index', [
            'collection' => $collection,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the associated collection.
     *
     * @param string $disk
     *
     * @return DataTableCollection
     */
    protected function getCollection(): DataTableCollection
    {
        $query = Asset::query();

        return new DataTableCollection($query, Asset::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getTableLabel(Asset::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getTableLabel(Asset::TABLE);
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Users;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Collections\DataTableCollection;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;

#endregion

class UserIndexController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function __invoke(Request $request): JsonResponse|View
    {
        $this->authorize(AbilityEnum::VIEW_ANY, User::class);

        $collection = $this->getCollection();

        return $this->renderBlade('narsil::pages.resources.index', [
            'collection' => $collection,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return DataTableCollection
     */
    protected function getCollection(): DataTableCollection
    {
        $query = User::query()
            ->with([
                User::RELATION_PERMISSIONS,
                User::RELATION_ROLES,
            ])
            ->withCount([
                User::RELATION_PERMISSIONS,
                User::RELATION_ROLES,
            ]);

        return new DataTableCollection($query, User::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getTableLabel(User::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getTableLabel(User::TABLE);
    }

    #endregion
}

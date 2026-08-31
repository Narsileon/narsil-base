<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Policies\Roles;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Collections\DataTableCollection;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\ModelService;

#endregion

class RoleIndexController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function __invoke(Request $request): JsonResponse|View
    {
        $this->authorize(AbilityEnum::VIEW_ANY, Role::class);

        $collection = $this->getCollection();

        return $this->renderBlade('narsil::pages.resources.index', [
            'collection' => $collection,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the associated collection.
     *
     * @return DataTableCollection
     */
    protected function getCollection(): DataTableCollection
    {
        $query = Role::query()
            ->with([
                Role::RELATION_PERMISSIONS,
                Role::RELATION_USERS,
            ])
            ->withCount([
                Role::RELATION_PERMISSIONS,
                Role::RELATION_USERS,
            ]);

        return new DataTableCollection($query, Role::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getTableLabel(Role::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getTableLabel(Role::TABLE);
    }

    #endregion
}

<?php

namespace Narsil\Base\Http\Controllers\Storages\Assets;

#region USE

use Illuminate\Http\RedirectResponse;
use Narsil\Base\Contracts\Requests\AssetFormRequest;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Storages\Asset;
use Narsil\Base\Services\ModelService;

#endregion

class AssetStoreController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param AssetFormRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(AssetFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        Asset::create($attributes);

        return $this
            ->redirect(route('assets.index'))
            ->with('success', ModelService::getSuccessMessage(Asset::TABLE, ModelEventEnum::CREATED));
    }

    #endregion
}

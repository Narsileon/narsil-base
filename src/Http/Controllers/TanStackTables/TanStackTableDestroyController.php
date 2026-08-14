<?php

namespace Narsil\Base\Http\Controllers\TanStackTables;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Contracts\Requests\TanStackTableFormRequest;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableDestroyController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function __invoke(TanStackTableFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        TanStackTable::query()
            ->where(TanStackTable::USER_ID, Auth::id())
            ->where(TanStackTable::TABLE_NAME, Arr::get($attributes, TanStackTable::TABLE_NAME))
            ->where(TanStackTable::NAME, Arr::get($attributes, TanStackTable::NAME))
            ->delete();

        return back();
    }

    #endregion
}

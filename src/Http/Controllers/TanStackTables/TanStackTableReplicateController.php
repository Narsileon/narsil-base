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

class TanStackTableReplicateController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param TanStackTable $table
     *
     * @return RedirectResponse
     */
    public function __invoke(TanStackTableFormRequest $request, TanStackTable $table): RedirectResponse
    {
        $attributes = $request->validated();

        $master = $table->{TanStackTable::RELATION_MASTER} ?? $table;

        $replicated = $table->replicate();

        $replicated
            ->fill([
                TanStackTable::MASTER_UUID => $master->{TanStackTable::UUID},
                TanStackTable::NAME => Arr::get($attributes, TanStackTable::NAME),
                TanStackTable::USER_ID => Auth::id(),
            ])
            ->save();

        $master->update([
            TanStackTable::PRESET_UUID => $replicated->{TanStackTable::UUID},
        ]);

        return back();
    }

    #endregion
}

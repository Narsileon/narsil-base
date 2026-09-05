<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\TanStackTables;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableDestroyController
{
    #region PUBLIC METHODS

    /**
     * @param TanStackTable $table
     *
     * @return RedirectResponse
     */
    public function __invoke(TanStackTable $table): RedirectResponse
    {
        TanStackTable::query()
            ->whereKey($table->getKey())
            ->where(TanStackTable::USER_ID, Auth::id())
            ->delete();

        return back();
    }

    #endregion
}

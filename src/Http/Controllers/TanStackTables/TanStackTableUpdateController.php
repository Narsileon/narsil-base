<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\TanStackTables;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Narsil\Base\Contracts\Requests\TanStackTableFormRequest;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableUpdateController
{
    #region PUBLIC METHODS

    /**
     * @param TanStackTableFormRequest $request
     * @param TanStackTable $table
     *
     * @return RedirectResponse
     */
    public function __invoke(TanStackTableFormRequest $request, TanStackTable $table): RedirectResponse
    {
        $attributes = $request->validated();

        $table->update($attributes);

        return back();
    }

    #endregion
}

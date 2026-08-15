<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Fetch;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

#endregion

class FetchFormController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $form): JsonResponse
    {
        $form = app($form);

        return response()->json($form);
    }

    #endregion
}

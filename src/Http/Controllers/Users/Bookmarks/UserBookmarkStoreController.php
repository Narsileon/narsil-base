<?php

namespace Narsil\Base\Http\Controllers\Users\Bookmarks;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Contracts\Requests\UserBookmarkFormRequest;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Http\Requests\UserBookmarkRequest;
use Narsil\Base\Models\Users\UserBookmark;

#endregion

class UserBookmarkStoreController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param UserBookmarkRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(UserBookmarkFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        UserBookmark::firstOrCreate([
            UserBookmark::USER_ID => Auth::id(),
            ...$attributes
        ]);

        return back();
    }

    #endregion
}

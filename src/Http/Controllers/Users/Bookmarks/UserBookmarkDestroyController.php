<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Users\Bookmarks;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Users\UserBookmark;

#endregion

class UserBookmarkDestroyController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param UserBookmark $userBookmark
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, UserBookmark $userBookmark): RedirectResponse
    {
        if ($userBookmark->{UserBookmark::USER_ID} !== Auth::id())
        {
            abort(403);
        }

        $userBookmark->delete();

        return back();
    }

    #endregion
}

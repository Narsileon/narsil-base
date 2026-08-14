<?php

namespace Narsil\Base\Http\Controllers\Users\Bookmarks;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Contracts\Requests\UserBookmarkFormRequest;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Models\Users\UserBookmark;

#endregion

class UserBookmarkUpdateController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param UserBookmarkRequest $request
     * @param UserBookmark $template
     *
     * @return RedirectResponse
     */
    public function __invoke(UserBookmarkFormRequest $request, UserBookmark $userBookmark): RedirectResponse
    {
        if ($userBookmark->{UserBookmark::USER_ID} !== Auth::id())
        {
            abort(403);
        }

        $attributes = $request->validated();

        $userBookmark->update($attributes);

        return back();
    }

    #endregion
}

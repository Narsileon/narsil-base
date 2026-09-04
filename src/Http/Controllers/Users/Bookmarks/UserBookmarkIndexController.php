<?php

declare(strict_types=1);

namespace Narsil\Base\Http\Controllers\Users\Bookmarks;

#region USE

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Narsil\Base\Http\Collections\UserBookmarkCollection;
use Narsil\Base\Models\User;

#endregion

class UserBookmarkIndexController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return UserBookmarkCollection
     */
    public function __invoke(Request $request): UserBookmarkCollection
    {
        $userBookmarks = Auth::user()->{User::RELATION_BOOKMARKS};

        return new UserBookmarkCollection($userBookmarks);
    }

    #endregion
}

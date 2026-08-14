<?php

namespace Narsil\Base\Implementations\Resources;

#region USE

use Illuminate\Http\Request;
use Narsil\Base\Contracts\Resources\UserResource as Contract;
use Narsil\Base\Implementations\Resource;
use Narsil\Base\Models\User;

#endregion

class UserResource extends Resource implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function toArray(Request $request): array
    {
        return [
            User::AVATAR => $this->{User::AVATAR},
            User::EMAIL => $this->{User::EMAIL},
            User::FIRST_NAME => $this->{User::FIRST_NAME},
            User::LAST_NAME => $this->{User::LAST_NAME},
            User::TWO_FACTOR_CONFIRMED_AT => $this->{User::TWO_FACTOR_CONFIRMED_AT},
        ];
    }

    #endregion
}

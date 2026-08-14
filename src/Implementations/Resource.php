<?php

namespace Narsil\Base\Implementations;

#region USE

use Illuminate\Http\Resources\Json\JsonResource;
use Narsil\Base\Contracts\Resource as Contract;

#endregion

class Resource extends JsonResource implements Contract
{
    #region PROPERTIES

    /**
     * {@inheritDoc}
     */
    public static $wrap = false;

    #endregion
}

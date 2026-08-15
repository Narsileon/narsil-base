<?php

declare(strict_types=1);

namespace Narsil\Base\Interfaces;

#region USE

use Illuminate\Database\Eloquent\Casts\Attribute;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Traits\HasIdentifier;

#endregion

interface Searchable
{
    #region PUBLIC METHODS

    /**
     * @return OptionData
     */
    public function toOption(): OptionData;

    #endregion
}

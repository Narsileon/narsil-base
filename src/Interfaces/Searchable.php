<?php

declare(strict_types=1);

namespace Narsil\Base\Interfaces;

#region USE

use Narsil\Base\Http\Data\OptionData;

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

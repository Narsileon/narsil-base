<?php

declare(strict_types=1);

namespace Narsil\Base\Traits;

#region USE

use DateTimeInterface;

#endregion

trait HasDatetimes
{
    #region PROTECTED METHODS

    /**
     * @param DateTimeInterface $date
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    #endregion
}

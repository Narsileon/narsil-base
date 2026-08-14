<?php

declare(strict_types=1);

namespace Narsil\Base\Contracts;

#region USE

use Narsil\Base\Http\Data\ModelHookContext;

#endregion

interface ModelHook
{
    #region PUBLIC METHODS

    /**
     * @param ModelHookContext $context
     *
     * @return void
     */
    public function handle(ModelHookContext $context): void;

    #endregion
}

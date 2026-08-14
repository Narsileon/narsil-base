<?php

declare(strict_types=1);

namespace Narsil\Base\Resources;

#region USE

use Narsil\Base\Contracts\ModelDefinition;
use Narsil\Base\Enums\ModelOperationEnum;

#endregion

abstract class AbstractModelDefinition implements ModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function editWith(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function indexWith(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function indexWithCount(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [
            ModelOperationEnum::CREATE,
            ModelOperationEnum::DESTROY,
            ModelOperationEnum::DESTROY_MANY,
            ModelOperationEnum::EDIT,
            ModelOperationEnum::INDEX,
            ModelOperationEnum::REPLICATE,
            ModelOperationEnum::REPLICATE_MANY,
            ModelOperationEnum::STORE,
            ModelOperationEnum::UPDATE,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function replicateAction(): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return null;
    }

    #endregion
}

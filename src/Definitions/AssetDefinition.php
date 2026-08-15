<?php

declare(strict_types=1);

namespace Narsil\Base\Definitions;

#region USE

use Narsil\Base\Definitions\AbstractModelDefinition;
use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Implementations\Forms\AssetForm;
use Narsil\Base\Implementations\Requests\AssetFormRequest;
use Narsil\Base\Implementations\Tables\AssetTable;
use Narsil\Base\Models\Storages\Asset;

#endregion

final class AssetDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return AssetForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Asset::class;
    }

    /**
     * {@inheritDoc}
     */
    public function morph(): ?string
    {
        return Asset::TABLE;
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
            ModelOperationEnum::STORE,
            ModelOperationEnum::UPDATE,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return AssetFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return Asset::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return AssetTable::class;
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Definitions;

#region USE

use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Resources\AbstractModelDefinition;
use Narsil\Base\Implementations\Forms\PermissionForm;
use Narsil\Base\Implementations\Requests\PermissionFormRequest;
use Narsil\Base\Implementations\Tables\PermissionTable;
use Narsil\Base\Models\Policies\Permission;

#endregion

final class PermissionDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return PermissionForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Permission::class;
    }

    /**
     * {@inheritDoc}
     */
    public function morph(): ?string
    {
        return Permission::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [
            ModelOperationEnum::EDIT,
            ModelOperationEnum::INDEX,
            ModelOperationEnum::UPDATE,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return PermissionFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return Permission::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return PermissionTable::class;
    }

    #endregion
}

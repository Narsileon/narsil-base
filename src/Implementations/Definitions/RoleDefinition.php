<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Definitions;

#region USE

use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Resources\AbstractModelDefinition;
use Narsil\Base\Implementations\Actions\Roles\ReplicateRole;
use Narsil\Base\Implementations\Forms\RoleForm;
use Narsil\Base\Implementations\Requests\RoleFormRequest;
use Narsil\Base\Implementations\Tables\RoleTable;
use Narsil\Base\Models\Policies\Role;

#endregion

final class RoleDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function editWith(): array
    {
        return [
            Role::RELATION_PERMISSIONS,
            Role::RELATION_USERS,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return RoleForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function indexWith(): array
    {
        return [
            Role::RELATION_PERMISSIONS,
            Role::RELATION_USERS,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * {@inheritDoc}
     */
    public function morph(): ?string
    {
        return Role::TABLE;
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
        return ReplicateRole::class;
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return RoleFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return Role::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return RoleTable::class;
    }

    #endregion
}

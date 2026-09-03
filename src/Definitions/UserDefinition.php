<?php

declare(strict_types=1);

namespace Narsil\Base\Definitions;

#region USE

use Narsil\Base\Definitions\AbstractModelDefinition;
use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Implementations\Events\CreateUserConfigurationEvent;
use Narsil\Base\Implementations\Forms\UserForm;
use Narsil\Base\Implementations\Requests\UserFormRequest;
use Narsil\Base\Implementations\Tables\UserTable;
use Narsil\Base\Models\User;

#endregion

final class UserDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function editWith(): array
    {
        return [
            User::RELATION_ROLES,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function events(): array
    {
        return [
            'created' => [
                CreateUserConfigurationEvent::class,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return UserForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function indexWith(): array
    {
        return [
            User::RELATION_ROLES,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * {@inheritDoc}
     */
    public function morph(): ?string
    {
        return User::TABLE;
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
        return UserFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return User::TABLE;
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return UserTable::class;
    }

    #endregion
}

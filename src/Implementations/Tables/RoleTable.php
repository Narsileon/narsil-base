<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\TanStackTables\Columns\DateTimeColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\NumberColumn;
use Narsil\Base\Http\Data\TanStackTables\Columns\TextColumn;
use Narsil\Base\Implementations\Table;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\User;
use Narsil\Base\Services\ModelService;

#endregion

class RoleTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Role::TABLE);
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function columns(): array
    {
        return [
            NumberColumn::make(
                id: Role::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: Role::NAME,
                visibility: true,
            ),
            TextColumn::make(
                id: Role::LABEL,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Permission::TABLE),
                id: Role::COUNT_PERMISSIONS,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(User::TABLE),
                id: Role::COUNT_USERS,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Role::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Role::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}

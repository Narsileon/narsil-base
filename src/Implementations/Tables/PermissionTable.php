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

class PermissionTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Permission::TABLE);
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
                id: Permission::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: Permission::NAME,
                visibility: true,
            ),
            TextColumn::make(
                id: Permission::LABEL,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Role::TABLE),
                id: Permission::COUNT_ROLES,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(User::TABLE),
                id: Permission::COUNT_USERS,
            ),
            DateTimeColumn::make(
                id: Permission::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: Permission::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}

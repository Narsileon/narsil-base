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

class UserTable extends Table
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(User::TABLE);
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
                id: User::ID,
                visibility: true,
            ),
            TextColumn::make(
                id: User::EMAIL,
                visibility: true,
            ),
            TextColumn::make(
                id: User::FIRST_NAME,
                visibility: true,
            ),
            TextColumn::make(
                id: User::LAST_NAME,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Role::TABLE),
                id: User::COUNT_ROLES,
                visibility: true,
            ),
            NumberColumn::make(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Permission::TABLE),
                id: User::COUNT_PERMISSIONS,
            ),
            DateTimeColumn::make(
                id: User::CREATED_AT,
                visibility: true,
            ),
            DateTimeColumn::make(
                id: User::UPDATED_AT,
                visibility: true,
            ),
        ];
    }

    #endregion
}

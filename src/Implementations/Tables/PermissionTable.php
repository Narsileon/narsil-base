<?php

namespace Narsil\Base\Implementations\Tables;

#region USE

use Narsil\Base\Http\Data\Forms\Inputs\DatetimeInputData;
use Narsil\Base\Http\Data\Forms\Inputs\NumberInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\TanStackTables\ColumnDefData;
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
            new ColumnDefData(
                id: Permission::ID,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Permission::NAME,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Permission::LABEL,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Role::TABLE),
                id: Permission::COUNT_ROLES,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(User::TABLE),
                id: Permission::COUNT_USERS,
                type: NumberInputData::TYPE,
            ),
            new ColumnDefData(
                id: Permission::CREATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Permission::UPDATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
        ];
    }

    #endregion
}

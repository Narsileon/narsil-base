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
            new ColumnDefData(
                id: Role::ID,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Role::NAME,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Role::LABEL,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Permission::TABLE),
                id: Role::COUNT_PERMISSIONS,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(User::TABLE),
                id: Role::COUNT_USERS,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Role::CREATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: Role::UPDATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
        ];
    }

    #endregion
}

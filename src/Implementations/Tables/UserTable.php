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
            new ColumnDefData(
                id: User::ID,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: User::EMAIL,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: User::FIRST_NAME,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: User::LAST_NAME,
                type: TextInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Role::TABLE),
                id: User::COUNT_ROLES,
                type: NumberInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                enableColumnFilter: false,
                header: ModelService::getTableLabel(Permission::TABLE),
                id: User::COUNT_PERMISSIONS,
                type: NumberInputData::TYPE,
            ),
            new ColumnDefData(
                id: User::CREATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
            new ColumnDefData(
                id: User::UPDATED_AT,
                type: DatetimeInputData::TYPE,
                visibility: true,
            ),
        ];
    }

    #endregion
}

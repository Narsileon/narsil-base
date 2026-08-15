<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Narsil\Base\Contracts\Forms\PermissionForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\RouteService;

#endregion

class PermissionForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(Permission::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        return [
            new FormStepData(
                elements: [
                    new FieldData(
                        id: Permission::NAME,
                        description: ModelService::getAttributeDescription(Permission::TABLE, Permission::NAME),
                        readOnly: true,
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: Permission::LABEL,
                        description: ModelService::getAttributeDescription(Permission::TABLE, Permission::LABEL),
                        required: true,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                ],
            ),
        ];
    }

    #endregion
}

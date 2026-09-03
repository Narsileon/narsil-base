<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Narsil\Base\Contracts\Forms\RoleForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\CheckboxInputData;
use Narsil\Base\Http\Data\Forms\Inputs\TextInputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Services\FormService;
use Narsil\Base\Services\ModelService;
use Narsil\Base\Services\RouteService;

#endregion

class RoleForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(Role::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return array
     */
    protected function getPermissionElements(): array
    {
        $options = FormService::getOptions(Permission::class);

        return $options
            ->groupBy(function (OptionData $option)
            {
                $key = Str::before($option->{Permission::NAME}, ':');

                return ModelService::getTableLabel($key);
            })
            ->sortKeys()
            ->map(function ($options, $group)
            {
                return new FieldData(
                    id: Role::RELATION_PERMISSIONS,
                    label: $group,
                    input: new CheckboxInputData(
                        options: $options->toArray(),
                    ),
                );
            })
            ->values()
            ->toArray();
    }

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $permissionElements = $this->getPermissionElements();

        return [
            new FormStepData(
                id: 'definition',
                label: trans('narsil::ui.definition'),
                elements: [
                    new FieldData(
                        id: Role::NAME,
                        description: ModelService::getAttributeDescription(Role::TABLE, Role::NAME),
                        required: true,
                        input: new TextInputData(),
                    ),
                    new FieldData(
                        id: Role::LABEL,
                        description: ModelService::getAttributeDescription(Role::TABLE, Role::LABEL),
                        required: true,
                        translatable: true,
                        input: new TextInputData(),
                    ),
                ],
            ),
            new FormStepData(
                id: Role::RELATION_PERMISSIONS,
                label: ModelService::getTableLabel(Permission::TABLE),
                elements: $permissionElements,
            ),
        ];
    }

    #endregion
}

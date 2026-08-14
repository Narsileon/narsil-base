<?php

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Contracts\Requests\PermissionFormRequest as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Validation\FormRule;

#endregion

class PermissionFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->permission)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->permission);
        }

        return Gate::allows(AbilityEnum::CREATE, Permission::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Permission::LABEL => [
                FormRule::REQUIRED,
            ],
        ];
    }

    #endregion
}

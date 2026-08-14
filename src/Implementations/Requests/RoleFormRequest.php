<?php

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Narsil\Base\Contracts\Requests\RoleFormRequest as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Validation\FormRule;

#endregion

class RoleFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->role)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->role);
        }

        return Gate::allows(AbilityEnum::CREATE, Role::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            Role::NAME => [
                FormRule::ALPHA_DASH,
                FormRule::LOWERCASE,
                FormRule::doesntStartWith('-'),
                FormRule::doesntEndWith('-'),
                FormRule::REQUIRED,
                FormRule::unique(
                    Role::class,
                    Role::NAME,
                )->ignore($this?->{Role::ID}),
            ],
            Role::LABEL => [
                FormRule::REQUIRED,
            ],
            Role::RELATION_PERMISSIONS => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
        ];
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;
use Narsil\Base\Contracts\Requests\UserFormRequest as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Models\User;
use Narsil\Base\Validation\FormRule;

#endregion

class UserFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->user)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->user);
        }

        return Gate::allows(AbilityEnum::CREATE, User::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            User::AVATAR => [
                File::image(),
                FormRule::NULLABLE,
            ],
            User::EMAIL => [
                FormRule::STRING,
                FormRule::EMAIL,
                FormRule::max(255),
                FormRule::REQUIRED,
                FormRule::unique(
                    User::class,
                    User::EMAIL,
                )->ignore($this->user?->{User::ID}),
            ],
            User::FIRST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::REQUIRED,
            ],
            User::LAST_NAME => [
                FormRule::STRING,
                FormRule::min(1),
                FormRule::max(255),
                FormRule::REQUIRED,
            ],
            User::PASSWORD => [
                FormRule::STRING,
                FormRule::min(8),
                FormRule::max(255),
                FormRule::CONFIRMED,
                $this->user ? FormRule::SOMETIMES : FormRule::REQUIRED
            ],

            User::RELATION_PERMISSIONS => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
            User::RELATION_ROLES => [
                FormRule::ARRAY,
                FormRule::SOMETIMES,
                FormRule::NULLABLE,
            ],
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function prepareForValidation(): void
    {
        if (empty($this->{User::PASSWORD}))
        {
            $this->merge([
                User::PASSWORD => ''
            ]);
        }
    }

    #endregion
}

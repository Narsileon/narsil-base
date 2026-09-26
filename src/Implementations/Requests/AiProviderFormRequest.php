<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Requests;

#region USE

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Narsil\Base\Contracts\Requests\AiProviderFormRequest as Contract;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Implementations\FormRequest;
use Narsil\Base\Models\AiProvider;
use Narsil\Base\Services\Ai\AiModelCatalog;
use Narsil\Base\Validation\FormRule;

#endregion

class AiProviderFormRequest extends FormRequest implements Contract
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function authorize(): bool
    {
        if ($this->aiProvider)
        {
            return Gate::allows(AbilityEnum::UPDATE, $this->aiProvider);
        }

        return Gate::allows(AbilityEnum::CREATE, AiProvider::class);
    }

    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        $providerId = $this->aiProvider?->{AiProvider::ID};

        return [
            AiProvider::API_KEY => $providerId
                ? [FormRule::NULLABLE, FormRule::STRING, FormRule::max(4096)]
                : [FormRule::REQUIRED, FormRule::STRING, FormRule::max(4096)],
            AiProvider::MODEL => [
                FormRule::REQUIRED,
                FormRule::STRING,
                FormRule::max(255),
            ],
            AiProvider::IS_DEFAULT => [
                FormRule::BOOLEAN,
                FormRule::SOMETIMES,
            ],
            AiProvider::PROVIDER => [
                FormRule::REQUIRED,
                FormRule::STRING,
                Rule::in(app(AiModelCatalog::class)->providerIds()),
                Rule::unique(AiProvider::class, AiProvider::PROVIDER)->ignore($providerId),
            ],
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function failedValidation(Validator $validator)
    {
        $this->request->remove(AiProvider::API_KEY);
        $this->query->remove(AiProvider::API_KEY);
        $this->json()->remove(AiProvider::API_KEY);

        parent::failedValidation($validator);
    }

    #endregion
}

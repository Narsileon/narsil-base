<?php

declare(strict_types=1);

namespace Narsil\Base\Definitions;

#region USE

use Narsil\Base\Enums\ModelHookEventEnum;
use Narsil\Base\Enums\ModelOperationEnum;
use Narsil\Base\Http\Data\ModelHookContext;
use Narsil\Base\Implementations\Forms\AiProviderForm;
use Narsil\Base\Implementations\Requests\AiProviderFormRequest;
use Narsil\Base\Implementations\Tables\AiProviderTable;
use Narsil\Base\Models\AiProvider;

#endregion

final class AiProviderDefinition extends AbstractModelDefinition
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function form(): ?string
    {
        return AiProviderForm::class;
    }

    /**
     * {@inheritDoc}
     */
    public function hooks(): array
    {
        $unsetOtherDefaults = function (ModelHookContext $context): void
        {
            if (!filter_var($context->attributes[AiProvider::IS_DEFAULT] ?? false, FILTER_VALIDATE_BOOLEAN))
            {
                return;
            }

            $providers = AiProvider::query()
                ->where(AiProvider::IS_DEFAULT, true);

            if ($context->model?->exists)
            {
                $providers->where(AiProvider::ID, '!=', $context->model->getKey());
            }

            $providers->update([
                AiProvider::IS_DEFAULT => false,
            ]);
        };

        return [
            ModelHookEventEnum::BEFORE_STORE->value => [
                [
                    'hook' => $unsetOtherDefaults,
                    'priority' => 0,
                ],
            ],
            ModelHookEventEnum::BEFORE_UPDATE->value => [
                [
                    'hook' => $unsetOtherDefaults,
                    'priority' => 10,
                ],
                [
                    'hook' => function (ModelHookContext $context): void
                    {
                        $key = $context->attributes[AiProvider::API_KEY] ?? null;

                        if (!is_string($key) || trim($key) === '')
                        {
                            unset($context->attributes[AiProvider::API_KEY]);
                        }
                    },
                    'priority' => 0,
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return AiProvider::class;
    }

    /**
     * {@inheritDoc}
     */
    public function operations(): array
    {
        return [
            ModelOperationEnum::CREATE,
            ModelOperationEnum::DESTROY,
            ModelOperationEnum::DESTROY_MANY,
            ModelOperationEnum::EDIT,
            ModelOperationEnum::INDEX,
            ModelOperationEnum::STORE,
            ModelOperationEnum::UPDATE,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function request(): ?string
    {
        return AiProviderFormRequest::class;
    }

    /**
     * {@inheritDoc}
     */
    public function route(): string
    {
        return 'ai-providers';
    }

    /**
     * {@inheritDoc}
     */
    public function table(): ?string
    {
        return AiProviderTable::class;
    }

    #endregion
}

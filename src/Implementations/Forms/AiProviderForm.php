<?php

declare(strict_types=1);

namespace Narsil\Base\Implementations\Forms;

#region USE

use Illuminate\Database\Eloquent\Model;
use Laravel\Ai\Ai;
use Narsil\Base\Contracts\Forms\AiProviderForm as Contract;
use Narsil\Base\Http\Data\Forms\FieldData;
use Narsil\Base\Http\Data\Forms\FormStepData;
use Narsil\Base\Http\Data\Forms\Inputs\PasswordInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SelectInputData;
use Narsil\Base\Http\Data\Forms\Inputs\SwitchInputData;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Base\Implementations\Form;
use Narsil\Base\Models\AiProvider;
use Narsil\Base\Services\Ai\AiModelCatalog;
use Narsil\Base\Services\RouteService;

#endregion

class AiProviderForm extends Form implements Contract
{
    #region CONSTRUCTOR

    /**
     * {@inheritDoc}
     */
    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->routes(RouteService::getNames(AiProvider::TABLE));
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getSteps(): array
    {
        $provider = null;

        if ($this->model instanceof AiProvider)
        {
            $provider = $this->model;
        }
        $defaultProvider = $provider?->{AiProvider::PROVIDER} ?? AiProvider::PROVIDER_GEMINI;
        $selectedProvider = $defaultProvider;

        if (request()->header('X-Narsil-Form-Reload') === 'true')
        {
            $selectedProvider = (string) request()->query(AiProvider::PROVIDER, $defaultProvider);
        }

        $defaultModel = $provider?->{AiProvider::MODEL};

        if (request()->header('X-Narsil-Form-Reload') === 'true')
        {
            if ($selectedProvider !== $defaultProvider)
            {
                $defaultModel = null;
            }
        }

        if (!is_string($defaultModel) || trim($defaultModel) === '')
        {
            if ($selectedProvider === AiProvider::PROVIDER_GEMINI)
            {
                $defaultModel = Ai::textProvider(AiProvider::PROVIDER_GEMINI)->defaultTextModel();
            }
        }

        $catalog = app(AiModelCatalog::class);
        $providerOptions = $catalog->providerOptions();

        if (!$catalog->hasProvider($selectedProvider))
        {
            $providerOptions[] = new OptionData($selectedProvider, $selectedProvider);
        }

        $modelOptions = $catalog->searchModels($selectedProvider);

        if (is_string($defaultModel) && trim($defaultModel) !== '')
        {
            $savedModelExists = false;

            foreach ($modelOptions as $modelOption)
            {
                if ($modelOption['value'] === $defaultModel)
                {
                    $savedModelExists = true;

                    break;
                }
            }

            if (!$savedModelExists)
            {
                $modelOptions[] = $catalog->modelOption($selectedProvider, $defaultModel);
            }
        }

        $elements = [
            new FieldData(
                id: AiProvider::PROVIDER,
                input: new SelectInputData(
                    defaultValue: $selectedProvider,
                    options: $providerOptions,
                    reload: 'form',
                    clearOnReload: [AiProvider::MODEL],
                ),
                label: trans('narsil::ui.provider'),
                required: true,
            ),
            new FieldData(
                id: AiProvider::API_KEY,
                input: new PasswordInputData(
                    autoComplete: 'new-password',
                    maxLength: 4096,
                    minLength: 1,
                ),
                label: trans('narsil::ui.api_key'),
                required: !$provider,
            ),
            new FieldData(
                id: AiProvider::MODEL,
                input: new SelectInputData(
                    defaultValue: $defaultModel ?? '',
                    options: $modelOptions,
                ),
                label: trans('narsil::ui.model'),
                required: true,
            ),
            new FieldData(
                id: AiProvider::IS_DEFAULT,
                input: new SwitchInputData(
                    defaultValue: (bool) ($provider?->{AiProvider::IS_DEFAULT} ?? false),
                ),
                label: trans('narsil::ui.default'),
            ),
        ];

        return [
            new FormStepData(
                elements: $elements,
            ),
        ];
    }

    #endregion
}

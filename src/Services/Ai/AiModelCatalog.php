<?php

declare(strict_types=1);

namespace Narsil\Base\Services\Ai;

#region USE

use Composer\InstalledVersions;
use Illuminate\Support\Str;
use RuntimeException;

#endregion

final class AiModelCatalog
{
    #region PROPERTIES

    /**
     * @var array<string,mixed>|null
     */
    private static ?array $catalog = null;

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $provider
     *
     * @return boolean
     */
    public function hasProvider(string $provider): bool
    {
        return array_key_exists($this->catalogProviderId($provider), $this->catalog());
    }

    /**
     * @param string $provider
     * @param string $model
     *
     * @return array{label:string,searchLabel:string,value:string}
     */
    public function modelOption(string $provider, string $model): array
    {
        $option = [
            'label' => $model,
            'searchLabel' => $model,
            'value' => $model,
        ];

        foreach ($this->searchModels($provider, $model) as $catalogOption)
        {
            if ($catalogOption['value'] === $model)
            {
                $option = $catalogOption;

                break;
            }
        }

        return $option;
    }

    /**
     * @return string[]
     */
    public function providerIds(): array
    {
        return array_map(
            function (array $option): string
            {
                return $option['value'];
            },
            $this->providerOptions(),
        );
    }

    /**
     * @return array<int,array{label:string,searchLabel:string,value:string}>
     */
    public function providerOptions(): array
    {
        $options = [];

        foreach ($this->catalog() as $id => $provider)
        {
            $providerId = (string) $id;
            $label = (string) ($provider['name'] ?? $id);

            if ($id === 'google')
            {
                $providerId = 'gemini';
                $label = 'Gemini';
            }

            $options[] = [
                'label' => $label,
                'searchLabel' => "$label $providerId",
                'value' => $providerId,
            ];
        }

        usort($options, function (array $left, array $right): int
        {
            return strcasecmp($left['label'], $right['label']);
        });

        return $options;
    }

    /**
     * @param string $provider
     * @param string $search
     *
     * @return array<int,array{label:string,searchLabel:string,value:string}>
     */
    public function searchModels(string $provider, string $search = ''): array
    {
        $providerId = $this->catalogProviderId($provider);
        $models = $this->catalog()[$providerId]['models'] ?? [];
        $search = Str::lower(trim($search));
        $options = [];

        if (is_array($models))
        {
            foreach ($models as $modelKey => $model)
            {
                if (!is_array($model))
                {
                    continue;
                }

                $modelId = (string) ($model['id'] ?? $modelKey);
                $label = (string) ($model['name'] ?? $modelId);
                $searchLabel = "$modelId $label";

                if ($search !== '' && !Str::contains(Str::lower($searchLabel), $search))
                {
                    continue;
                }

                $options[] = [
                    'label' => $label,
                    'searchLabel' => $searchLabel,
                    'value' => $modelId,
                ];
            }
        }

        return $options;
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return array<string,mixed>
     */
    private function catalog(): array
    {
        if (self::$catalog === null)
        {
            $path = InstalledVersions::getInstallPath('symfony/models-dev');

            if (!is_string($path))
            {
                throw new RuntimeException('The Symfony model catalog is not installed.');
            }

            $contents = file_get_contents("$path/models-dev.json");
            $catalog = null;

            if (is_string($contents))
            {
                $catalog = json_decode($contents, true);
            }

            if (!is_array($catalog))
            {
                throw new RuntimeException('The Symfony model catalog could not be loaded.');
            }

            self::$catalog = $catalog;
        }

        return self::$catalog;
    }

    /**
     * @param string $provider
     *
     * @return string
     */
    private function catalogProviderId(string $provider): string
    {
        $catalogProvider = $provider;

        if ($provider === 'gemini')
        {
            $catalogProvider = 'google';
        }

        return $catalogProvider;
    }

    #endregion
}

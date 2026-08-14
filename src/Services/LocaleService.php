<?php

namespace Narsil\Base\Services;

#region USE

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Locale;
use Narsil\Base\Http\Data\OptionData;
use ResourceBundle;

#endregion

abstract class LocaleService
{
    #region PUBLIC METHODS

    /**
     * Get the country options.
     *
     * @param string[] $countries
     *
     * @return array<OptionData>
     */
    public static function countryOptions(?array $countries = null): array
    {
        if ($countries)
        {
            $codes = collect($countries);
        }
        else
        {
            $codes = collect(ResourceBundle::getLocales(''))
                ->map(function ($locale)
                {
                    return Locale::getRegion($locale);
                });
        }

        return $codes
            ->filter(function ($code)
            {
                return Str::length($code) === 2 && ctype_alpha($code);
            })
            ->unique()
            ->map(function ($code)
            {
                $label = Locale::getDisplayRegion('_' . $code, App::getLocale());

                if (!$label || $label === $code)
                {
                    return null;
                }

                return new OptionData(
                    label: ucfirst($label),
                    value: $code
                );
            })
            ->filter()
            ->sortBy(function (OptionData $option)
            {
                return $option->label;
            }, SORT_NATURAL | SORT_FLAG_CASE)
            ->values()
            ->all();
    }

    /**
     * Get the language options.
     *
     * @param string[] $languages
     *
     * @return array<SelectOption>
     */
    public static function languageOptions(?array $languages = null): array
    {
        if ($languages)
        {
            $codes = collect($languages);
        }
        else
        {
            $codes = collect(ResourceBundle::getLocales(''))
                ->map(function ($locale)
                {
                    return Locale::getPrimaryLanguage($locale);
                });
        }

        return $codes
            ->filter(function ($code)
            {
                return Str::length($code) === 2 && ctype_alpha($code);
            })
            ->unique()
            ->map(function ($code)
            {
                $label = Locale::getDisplayLanguage($code, App::getLocale());

                if (!$label || $label === $code)
                {
                    return null;
                }

                return new OptionData(
                    label: ucfirst($label),
                    value: $code
                );
            })
            ->filter()
            ->sortBy(function (OptionData $option)
            {
                return $option->label;
            }, SORT_NATURAL | SORT_FLAG_CASE)
            ->values()
            ->all();
    }

    #endregion
}

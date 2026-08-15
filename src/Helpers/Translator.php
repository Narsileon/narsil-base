<?php

declare(strict_types=1);

namespace Narsil\Base\Helpers;

#region USE

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

#endregion

abstract class Translator
{
    #region PUBLIC METHODS

    /**
     * @param string $attribute
     * @param array<string,mixed> $replace
     * @param string|null $locale
     *
     * @return string
     */
    public static function trans(string $attribute, array $replace = [], ?string $locale = null): string
    {
        $namespaces = static::getNamespaces();

        foreach ($namespaces as $namespace)
        {
            if (Lang::has("$namespace::$attribute", $locale))
            {
                return trans("$namespace::$attribute", $replace, $locale);
            }
        }

        return $attribute;
    }

    /**
     * @param string $attribute
     * @param integer $number
     * @param array<string,mixed> $replace
     * @param string|null $locale
     *
     * @return string
     */
    public static function transChoice(string $attribute, int $number = 0, array $replace = [], ?string $locale = null): string
    {
        $namespaces = static::getNamespaces();

        foreach ($namespaces as $namespace)
        {
            if (Lang::has("$namespace::$attribute", $locale))
            {
                return trans_choice("$namespace::$attribute", $number, $replace, $locale);
            }
        }

        return $attribute;
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return array
     */
    protected static function getNamespaces(): array
    {
        return Cache::rememberForever('lang-namespaces', function ()
        {
            $namespaces = Lang::getLoader()->namespaces();

            return array_filter(array_keys($namespaces), function ($namespace)
            {
                return Str::contains($namespace, 'narsil');
            });
        });
    }

    #endregion
}

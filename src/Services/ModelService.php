<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Illuminate\Support\Str;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Helpers\Translator;

#endregion

abstract class ModelService
{
    #region PUBLIC METHODS

    /**
     * @param string $table
     * @param string $attribute
     * @param array $replace
     *
     * @return string
     */
    final public static function getAttributeDescription(string $table, string $attribute, array $replace = []): string
    {
        return Translator::trans("descriptions.$table.$attribute", $replace);
    }

    /**
     * @param string $table
     * @param boolean $ucFirst
     * @param string|null $locale
     *
     * @return string
     */
    final public static function getModelLabel(string $table, bool $ucFirst = true, ?string $locale = null): string
    {
        $key = "models.$table";

        $label = Translator::transChoice($key, 1, [], $locale);

        if ($label === $key)
        {
            $label = DatabaseService::getUnqualifiedTableName($table);
        }

        if ($ucFirst)
        {
            $label = Str::ucfirst($label);
        }

        return $label;
    }

    /**
     * @param string $table
     * @param ModelEventEnum $event
     *
     * @return string
     */
    public static function getSuccessMessage(string $table, ModelEventEnum $event): string
    {
        $modelLabel = static::getModelLabel($table, false);
        $tableLabel = static::getTableLabel($table, false);

        return Translator::trans("toasts.success.$event->value", [
            'model' => $modelLabel,
            'table' => $tableLabel,
        ]);
    }

    /**
     * @param string $table
     * @param boolean $ucFirst
     * @param string|null $locale
     *
     * @return string
     */
    final public static function getTableLabel(string $table, bool $ucFirst = true, ?string $locale = null): string
    {
        $key = "models.$table";

        $label = Translator::transChoice($key, 2, [], $locale);

        if ($label === $key)
        {
            $label = DatabaseService::getUnqualifiedTableName($table);
        }

        if ($ucFirst)
        {
            $label = Str::ucfirst($label);
        }

        return $label;
    }

    #endregion
}

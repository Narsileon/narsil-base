<?php

namespace Narsil\Base\Services;

#region USE

use Narsil\Base\Enums\AbilityEnum;

#endregion

abstract class PermissionService
{
    #region PUBLIC METHODS

    /**
     * Get the label of the permission based on the name of the table.
     *
     * @param string $table
     * @param string $permission
     * @param string|null $locale
     *
     * @return string
     */
    public static function getLabel(string $table, string $permission, ?string $locale = null): string
    {
        return trans("narsil::abilities.$permission", [
            'model' => ModelService::getModelLabel($table, false, $locale),
            'table' => ModelService::getTableLabel($table, false, $locale),
        ], $locale);
    }

    /**
     * Get the name of the permission based on the name of the table.
     *
     * @param string $table
     * @param AbilityEnum $ability
     *
     * @return string
     */
    public static function getName(string $table, AbilityEnum $ability): string
    {
        return $table . ':' . $ability->value;
    }

    #endregion
}

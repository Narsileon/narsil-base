<?php

declare(strict_types=1);

namespace Narsil\Base\Services;

#region USE

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

#endregion

abstract class RouteService
{
    #region PUBLIC METHODS

    /**
     * @param string $table
     * @param array $parameters
     *
     * @return array
     */
    public static function getNames(string $table, array $parameters = []): array
    {
        $slug = Str::slug($table);

        $names = [
            'create' => "$slug.create",
            'destroy' => "$slug.destroy",
            'destroyMany' => "$slug.destroy-many",
            'edit' => "$slug.edit",
            'index' => "$slug.index",
            'publish' => "$slug.publish",
            'publishMany' => "$slug.publish-many",
            'replicate' => "$slug.replicate",
            'replicateMany' => "$slug.replicate-many",
            'restore' => "$slug.restore",
            'restoreMany' => "$slug.restore-many",
            'show' => "$slug.show",
            'store' => "$slug.store",
            'unpublish' => "$slug.unpublish",
            'unpublishMany' => "$slug.unpublish-many",
            'update' => "$slug.update",
        ];

        $names = array_filter($names, function ($name)
        {
            return Route::has($name);
        });

        $names['parameters'] = $parameters;

        if (isset($names['edit']))
        {
            $route = Route::getRoutes()->getByName($names['edit']);
            $routeParameters = $route?->parameterNames() ?? [];

            $names['parameter'] = collect($routeParameters)
                ->reject(fn ($parameter) => array_key_exists($parameter, $parameters))
                ->last() ?? 'id';
        }

        return $names;
    }

    #endregion
}

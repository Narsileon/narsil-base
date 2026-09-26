<?php

declare(strict_types=1);

namespace Narsil\Base\Console\Commands;

#region USE

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Narsil;
use Narsil\Base\Services\PermissionService;
use ReflectionClass;

#endregion

class SyncPermissions extends Command
{
    #region PROPERTIES

    /**
     * {@inheritDoc}
     */
    protected $description = 'Generate permissions based on policy methods.';

    /**
     * {@inheritDoc}
     */
    protected $signature = 'narsil:sync-permissions';

    #endregion

    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function handle(): void
    {
        $narsil = app(Narsil::class);
        $models = array_unique(array_merge(
            array_keys($narsil->morphs()),
            array_keys($narsil->modelDefinitions()),
        ));

        foreach ($models as $model)
        {
            if (!class_exists($model))
            {
                continue;
            }

            $attributes = new ReflectionClass($model)
                ->getAttributes(UsePolicy::class);

            if ($attributes === [])
            {
                continue;
            }

            $policy = $attributes[0]->newInstance()->class;
            $policyReflection = new ReflectionClass($policy);
            $table = $model::TABLE;

            foreach ($policyReflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method)
            {
                $ability = AbilityEnum::tryFrom($method->getName());

                if (!$ability)
                {
                    continue;
                }

                $name = PermissionService::getName($table, $ability);
                $labels = [];

                foreach ($narsil->getLocales() as $locale)
                {
                    $labels[$locale] = PermissionService::getLabel($table, $ability->value, $locale);
                }

                Permission::firstOrCreate([
                    Permission::NAME => $name,
                ], [
                    Permission::LABEL => $labels,
                ]);

                $this->line("The permission '{$name}' has been created.");
            }
        }

        $this->info('The permissions have been successfully synchronized.');
    }

    #endregion
}

<?php

declare(strict_types=1);

namespace Narsil\Base\Traits;

#region USE

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Narsil\Base\Models\Users\UserConfiguration;
use Narsil\Base\Narsil;

#endregion

/**
 * @author Jonathan Rigaux
 */
trait HasSchemas
{
    #region PROTECTED METHODS

    /**
     * @return string
     */
    protected function getCurrentSchema(): string
    {
        $defaultSchema = $this->getDefaultSchema();

        return Session::get(UserConfiguration::SCHEMA, $defaultSchema);
    }

    /**
     * @return string
     */
    protected function getDefaultSchema(): string
    {
        $schemas = $this->getSchemas();

        $fallbackSchema = $this->getFallbackSchema();

        return array_first($schemas) ?? $fallbackSchema;
    }

    /**
     * @return string
     */
    protected function getFallbackSchema(): string
    {
        return Config::get('database.connections.pgsql.search_path', 'public');
    }

    /**
     * @return string[]
     */
    protected function getSchemas(): array
    {
        $fallbackSchema = $this->getFallbackSchema();

        $schemas = app(Narsil::class)->getSchemas();

        if (empty($schemas))
        {
            $schemas[] = $fallbackSchema;
        }

        return $schemas;
    }

    /**
     * @param string $schema
     *
     * @return void
     */
    protected function setSearchPath(string $schema): void
    {
        $fallbackSchema = $this->getFallbackSchema();

        $schemas = $this->getSchemas();

        if (!in_array($schema, $schemas))
        {
            $schema = $fallbackSchema;
        }

        DB::statement("SET search_path TO $schema, $fallbackSchema");

        Session::put(UserConfiguration::SCHEMA, $schema);
    }

    #endregion
}

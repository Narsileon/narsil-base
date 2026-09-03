<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\Caches\Cache;
use Narsil\Base\Models\Caches\CacheLock;
use Narsil\Base\Traits\HasSchemas;

#endregion

return new class extends Migration
{
    use HasSchemas;

    #region PUBLIC METHODS

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $schema = $this->getFallbackSchema();

        if (!Schema::hasTable("$schema." . Cache::TABLE))
        {
            $this->createCacheTable($schema);
        }
        if (!Schema::hasTable("$schema." . CacheLock::TABLE))
        {
            $this->createCacheLocksTable($schema);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $schema = $this->getFallbackSchema();

        Schema::dropIfExists("$schema." . CacheLock::TABLE);
        Schema::dropIfExists("$schema." . Cache::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the cache table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createCacheTable(string $schema): void
    {
        Schema::create("$schema." . Cache::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->string(Cache::KEY)
                ->primary();
            $blueprint
                ->mediumText(Cache::VALUE);
            $blueprint
                ->integer(Cache::EXPIRATION);
        });
    }

    /**
     * Create the cache locks table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createCacheLocksTable(string $schema): void
    {
        Schema::create("$schema." . CacheLock::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->string(CacheLock::KEY)
                ->primary();
            $blueprint
                ->string(CacheLock::OWNER);
            $blueprint
                ->integer(CacheLock::EXPIRATION);
        });
    }

    #endregion
};

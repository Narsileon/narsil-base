<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\Storages\Asset;
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

        if (!Schema::hasTable("$schema." . Asset::TABLE))
        {
            $this->createAssetsTable($schema);
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

        Schema::dropIfExists("$schema." . Asset::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the assets table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createAssetsTable(string $schema): void
    {
        Schema::create("$schema." . Asset::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(Asset::UUID)
                ->primary();
            $blueprint
                ->string(Asset::PATH)
                ->index();
            $blueprint
                ->jsonb(Asset::ALT)
                ->nullable();
            $blueprint
                ->timestamps();
        });
    }

    #endregion
};

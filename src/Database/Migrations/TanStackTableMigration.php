<?php

declare(strict_types=1);

namespace Narsil\Base\Database\Migrations;

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\TanStackTable;

#endregion

class TanStackTableMigration extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(TanStackTable::TABLE);
    }

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(TanStackTable::TABLE))
        {
            $this->createTanStackTablesTable();
        }
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function createTanStackTablesTable(): void
    {
        Schema::create(TanStackTable::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(TanStackTable::UUID)
                ->primary();
            $blueprint
                ->foreignId(TanStackTable::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(TanStackTable::TABLE_NAME)
                ->index();
            $blueprint
                ->uuid(TanStackTable::MASTER_UUID)
                ->nullable();
            $blueprint
                ->uuid(TanStackTable::PRESET_UUID)
                ->nullable();
            $blueprint
                ->string(TanStackTable::NAME)
                ->nullable()
                ->index();
            $blueprint
                ->string(TanStackTable::GLOBAL_FILTER)
                ->nullable();
            $blueprint
                ->json(TanStackTable::COLUMN_FILTERS)
                ->nullable();
            $blueprint
                ->json(TanStackTable::COLUMN_ORDER)
                ->nullable();
            $blueprint
                ->json(TanStackTable::COLUMN_VISIBILITY)
                ->nullable();
            $blueprint
                ->integer(TanStackTable::PAGE_SIZE)
                ->default(10);
            $blueprint
                ->json(TanStackTable::ROW_SELECTION)
                ->nullable();
            $blueprint
                ->json(TanStackTable::SORTING)
                ->nullable();
            $blueprint
                ->timestamps();
        });

        Schema::table(TanStackTable::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->foreign(TanStackTable::MASTER_UUID)
                ->nullable()
                ->references(TanStackTable::UUID)
                ->on(TanStackTable::TABLE)
                ->cascadeOnDelete();
            $blueprint
                ->foreign(TanStackTable::PRESET_UUID)
                ->nullable()
                ->references(TanStackTable::UUID)
                ->on(TanStackTable::TABLE)
                ->nullOnDelete();
        });
    }

    #endregion
}

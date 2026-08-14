<?php

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
    #region CONSTRUCTOR

    /**
     * @param string $schema
     *
     * @return void
     */
    public function __construct(string $schema)
    {
        $this->schema = $schema;
    }

    #endregion

    #region PROPERTIES

    /**
     * The name of the schema.
     *
     * @var string
     */
    protected readonly string $schema;

    #endregion

    #region PUBLIC METHODS

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {

        if (!Schema::hasTable($this->schema . '.' . TanStackTable::TABLE))
        {
            $this->createTanStackTablesTable($this->schema);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->schema . '.' . TanStackTable::TABLE);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Create the TanStack tables table.
     *
     * @param string $schema
     *
     * @return void
     */
    protected function createTanStackTablesTable(string $schema): void
    {
        Schema::create("$schema." . TanStackTable::TABLE, function (Blueprint $blueprint)
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

        Schema::table("$schema." . TanStackTable::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->foreign(TanStackTable::MASTER_UUID)
                ->nullable()
                ->references(TanStackTable::UUID)
                ->on($schema . '.' . TanStackTable::TABLE)
                ->cascadeOnDelete();
            $blueprint
                ->foreign(TanStackTable::PRESET_UUID)
                ->nullable()
                ->references(TanStackTable::UUID)
                ->on($schema . '.' . TanStackTable::TABLE)
                ->nullOnDelete();
        });
    }

    #endregion
};

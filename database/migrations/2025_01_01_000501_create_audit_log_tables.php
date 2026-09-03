<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Enums\ModelEventEnum;
use Narsil\Base\Models\AuditLog;
use Narsil\Base\Models\User;
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

        if (!Schema::hasTable("$schema." . AuditLog::TABLE))
        {
            $this->createAuditLogsTable($schema);
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

        Schema::dropIfExists("$schema." . AuditLog::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the audit logs table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createAuditLogsTable(string $schema): void
    {
        Schema::create("$schema." . AuditLog::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(AuditLog::UUID)
                ->primary();
            $blueprint
                ->string(AuditLog::MODEL_ID);
            $blueprint
                ->string(AuditLog::MODEL_TYPE);
            $blueprint
                ->foreignId(AuditLog::USER_ID)
                ->nullable()
                ->constrained("$schema." . User::TABLE, User::ID);
            $blueprint
                ->enum(AuditLog::EVENT, ModelEventEnum::values());
            $blueprint
                ->json(AuditLog::OLD_VALUES)
                ->nullable();
            $blueprint
                ->json(AuditLog::NEW_VALUES)
                ->nullable();
            $blueprint
                ->timestamps();

            $blueprint->index([
                AuditLog::MODEL_ID,
                AuditLog::MODEL_TYPE,
            ]);
        });
    }

    #endregion
};

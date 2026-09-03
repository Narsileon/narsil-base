<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\PasswordResetToken;
use Narsil\Base\Models\Users\Session;
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

        if (!Schema::hasTable("$schema." . User::TABLE))
        {
            $this->createUsersTable($schema);
        }
        if (!Schema::hasTable("$schema." . PasswordResetToken::TABLE))
        {
            $this->createPasswordResetTokensTable($schema);
        }
        if (!Schema::hasTable("$schema." . Session::TABLE))
        {
            $this->createSessionsTable($schema);
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

        Schema::dropIfExists("$schema." . Session::TABLE);
        Schema::dropIfExists("$schema." . PasswordResetToken::TABLE);
        Schema::dropIfExists("$schema." . User::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the password reset tokens table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createPasswordResetTokensTable(string $schema): void
    {
        Schema::create("$schema." . PasswordResetToken::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->string(PasswordResetToken::EMAIL)
                ->primary();
            $blueprint
                ->string(PasswordResetToken::TOKEN);
            $blueprint
                ->timestamp(PasswordResetToken::CREATED_AT)
                ->nullable();
        });
    }

    /**
     * Create the sessions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createSessionsTable(string $schema): void
    {
        Schema::create("$schema." . Session::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->string(Session::ID)
                ->primary();
            $blueprint
                ->foreignId(Session::USER_ID)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(Session::IP_ADDRESS, 45)
                ->nullable();
            $blueprint
                ->text(Session::USER_AGENT)
                ->nullable();
            $blueprint
                ->longText(Session::PAYLOAD);
            $blueprint
                ->integer(Session::LAST_ACTIVITY)
                ->index();
        });
    }

    /**
     * Create the users table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createUsersTable(string $schema): void
    {
        Schema::create("$schema." . User::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->id(User::ID);
            $blueprint
                ->boolean(User::ENABLED)
                ->default(false)
                ->index();
            $blueprint
                ->string(User::LAST_NAME)
                ->nullable();
            $blueprint
                ->string(User::FIRST_NAME)
                ->nullable();
            $blueprint
                ->string(User::EMAIL)
                ->unique();
            $blueprint
                ->timestamp(User::EMAIL_VERIFIED_AT)
                ->nullable();
            $blueprint
                ->string(User::PASSWORD);
            $blueprint
                ->text(User::TWO_FACTOR_SECRET)
                ->nullable();
            $blueprint
                ->text(User::TWO_FACTOR_RECOVERY_CODES)
                ->nullable();
            $blueprint
                ->timestamp(User::TWO_FACTOR_CONFIRMED_AT)
                ->nullable();
            $blueprint
                ->rememberToken();
            $blueprint
                ->string(User::AVATAR)
                ->nullable();
            $blueprint
                ->timestamp(User::CREATED_AT);
            $blueprint
                ->bigInteger(User::CREATED_BY)
                ->nullable();
            $blueprint
                ->timestamp(User::UPDATED_AT)
                ->index();
            $blueprint
                ->bigInteger(User::UPDATED_BY)
                ->nullable();
        });

        Schema::table("$schema." . User::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->foreign(User::CREATED_BY)
                ->references(User::ID)
                ->on("$schema." . User::TABLE)
                ->nullOnDelete();
            $blueprint
                ->foreign(User::UPDATED_BY)
                ->references(User::ID)
                ->on("$schema." . User::TABLE)
                ->nullOnDelete();
        });
    }

    #endregion
};

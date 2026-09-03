<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Enums\ColorEnum;
use Narsil\Base\Enums\ThemeEnum;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserConfiguration;
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

        if (!Schema::hasTable("$schema." . UserConfiguration::TABLE))
        {
            $this->createUserConfigurationsTable($schema);
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

        Schema::dropIfExists("$schema." . UserConfiguration::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the user configurations table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createUserConfigurationsTable(string $schema): void
    {
        $defaultLanguage = Config::get('app.locale', 'en');
        $defaultSchema = $this->getDefaultSchema();

        Schema::create("$schema." . UserConfiguration::TABLE, function (Blueprint $blueprint) use ($defaultLanguage, $defaultSchema)
        {
            $blueprint
                ->uuid(UserConfiguration::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserConfiguration::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(UserConfiguration::SCHEMA)
                ->default($defaultSchema);
            $blueprint
                ->string(UserConfiguration::LANGUAGE)
                ->default($defaultLanguage);
            $blueprint
                ->string(UserConfiguration::COLOR)
                ->default(ColorEnum::GRAY->value);
            $blueprint
                ->decimal(UserConfiguration::RADIUS, 3, 2)
                ->default(0.25);
            $blueprint
                ->string(UserConfiguration::THEME)
                ->default(ThemeEnum::SYSTEM->value);
            $blueprint
                ->jsonb(UserConfiguration::PREFERENCES)
                ->nullable();
            $blueprint
                ->timestamps();
        });
    }

    #endregion
};

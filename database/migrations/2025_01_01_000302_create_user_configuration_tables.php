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

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(UserConfiguration::TABLE))
        {
            $this->createUserConfigurationsTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(UserConfiguration::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createUserConfigurationsTable(): void
    {
        $defaultLanguage = Config::get('app.locale', 'en');
        Schema::create(UserConfiguration::TABLE, function (Blueprint $blueprint) use ($defaultLanguage)
        {
            $blueprint
                ->uuid(UserConfiguration::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserConfiguration::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
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

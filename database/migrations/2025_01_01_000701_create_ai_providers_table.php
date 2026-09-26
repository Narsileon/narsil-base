<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\AiProvider;

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(AiProvider::TABLE);
    }

    /**
     * @return void
     */
    public function up(): void
    {
        $table = AiProvider::TABLE;

        if (!Schema::hasTable($table))
        {
            Schema::create($table, function (Blueprint $blueprint)
            {
                $blueprint
                    ->id(AiProvider::ID);
                $blueprint
                    ->string(AiProvider::PROVIDER)
                    ->unique();
                $blueprint
                    ->text(AiProvider::API_KEY);
                $blueprint
                    ->string(AiProvider::MODEL);
                $blueprint
                    ->boolean(AiProvider::IS_DEFAULT)
                    ->default(false);
                $blueprint
                    ->timestamp(AiProvider::CREATED_AT)
                    ->nullable();
                $blueprint
                    ->timestamp(AiProvider::UPDATED_AT)
                    ->nullable();
            });
        }
    }

    #endregion
};

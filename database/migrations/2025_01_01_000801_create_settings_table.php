<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\Setting;

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Setting::TABLE);
    }

    /**
     * @return void
     */
    public function up(): void
    {
        $table = Setting::TABLE;

        if (!Schema::hasTable($table))
        {
            Schema::create($table, function (Blueprint $blueprint)
            {
                $blueprint
                    ->string(Setting::HANDLE)
                    ->primary();
                $blueprint
                    ->text(Setting::VALUE);
            });
        }
    }

    #endregion
};

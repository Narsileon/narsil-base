<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserBookmark;

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(UserBookmark::TABLE))
        {
            $this->createUserBookmarksTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(UserBookmark::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createUserBookmarksTable(): void
    {
        Schema::create(UserBookmark::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(UserBookmark::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserBookmark::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->string(UserBookmark::NAME);
            $blueprint
                ->string(UserBookmark::URL);
            $blueprint
                ->timestamps();
        });
    }

    #endregion
};

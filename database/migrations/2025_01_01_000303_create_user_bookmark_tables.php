<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Narsil\Base\Models\Users\UserBookmark;
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

        if (!Schema::hasTable("$schema." . UserBookmark::TABLE))
        {
            $this->createUserBookmarksTable($schema);
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

        Schema::dropIfExists("$schema." . UserBookmark::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the user bookmarks table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createUserBookmarksTable(string $schema): void
    {
        Schema::create("$schema." . UserBookmark::TABLE, function (Blueprint $blueprint)
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

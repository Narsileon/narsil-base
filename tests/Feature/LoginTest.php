<?php

declare(strict_types=1);

namespace Tests\Feature;

#region USE

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\User;
use Tests\TestCase;

#endregion

final class LoginTest extends TestCase
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function test_a_user_can_log_in_with_valid_credentials(): void
    {
        $response = $this->post('/login', [
            User::EMAIL => 'user@example.com',
            User::PASSWORD => 'correct-password',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
    }

    /**
     * @return void
     */
    public function test_invalid_credentials_do_not_log_in(): void
    {
        $response = $this->from('/login')->post('/login', [
            User::EMAIL => 'user@example.com',
            User::PASSWORD => 'wrong-password',
        ]);

        $response
            ->assertRedirect('/login')
            ->assertSessionHasErrors(User::EMAIL);

        $this->assertGuest();
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create(User::TABLE, function (Blueprint $blueprint)
        {
            $blueprint->id(User::ID);
            $blueprint->string(User::EMAIL)->unique();
            $blueprint->string(User::PASSWORD);
            $blueprint->boolean(User::ENABLED)->default(true);
            $blueprint->text(User::TWO_FACTOR_SECRET)->nullable();
            $blueprint->text(User::TWO_FACTOR_RECOVERY_CODES)->nullable();
            $blueprint->timestamp(User::TWO_FACTOR_CONFIRMED_AT)->nullable();
            $blueprint->rememberToken();
        });

        DB::table(User::TABLE)->insert([
            User::EMAIL => 'user@example.com',
            User::PASSWORD => Hash::make('correct-password'),
        ]);
    }

    #endregion
}

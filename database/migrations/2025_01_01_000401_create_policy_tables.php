<?php

declare(strict_types=1);

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Base\Models\Policies\Permission;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\Policies\RolePermission;
use Narsil\Base\Models\Policies\UserPermission;
use Narsil\Base\Models\Policies\UserRole;
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

        if (!Schema::hasTable("$schema." . Permission::TABLE))
        {
            $this->createPermissionsTable($schema);
        }
        if (!Schema::hasTable("$schema." . Role::TABLE))
        {
            $this->createRolesTable($schema);
        }
        if (!Schema::hasTable("$schema." . RolePermission::TABLE))
        {
            $this->createRolePermissionTable($schema);
        }
        if (!Schema::hasTable("$schema." . UserRole::TABLE))
        {
            $this->createUserRoleTable($schema);
        }
        if (!Schema::hasTable("$schema." . UserPermission::TABLE))
        {
            $this->createUserPermissionTable($schema);
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

        Schema::dropIfExists("$schema." . UserPermission::TABLE);
        Schema::dropIfExists("$schema." . UserRole::TABLE);
        Schema::dropIfExists("$schema." . RolePermission::TABLE);
        Schema::dropIfExists("$schema." . Role::TABLE);
        Schema::dropIfExists("$schema." . Permission::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * Create the permissions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createPermissionsTable(string $schema): void
    {
        Schema::create("$schema." . Permission::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->id(Permission::ID);
            $blueprint
                ->string(Permission::NAME)
                ->unique();
            $blueprint
                ->jsonb(Permission::LABEL)
                ->nullable();
            $blueprint
                ->timestamp(Permission::CREATED_AT);
            $blueprint
                ->foreignId(Role::CREATED_BY)
                ->nullable()
                ->constrained("$schema." . User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Permission::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Role::UPDATED_BY)
                ->nullable()
                ->constrained("$schema." . User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * Create the roles table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createRolesTable(string $schema): void
    {
        Schema::create("$schema." . Role::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->id(Role::ID);
            $blueprint
                ->string(Role::NAME)
                ->unique();
            $blueprint
                ->jsonb(Role::LABEL)
                ->nullable();
            $blueprint
                ->timestamp(Role::CREATED_AT);
            $blueprint
                ->foreignId(Role::CREATED_BY)
                ->nullable()
                ->constrained("$schema." . User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Role::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Role::UPDATED_BY)
                ->nullable()
                ->constrained("$schema." . User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * Create the role permissions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createRolePermissionTable(string $schema): void
    {
        Schema::create("$schema." . RolePermission::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(RolePermission::UUID)
                ->primary();
            $blueprint
                ->foreignId(RolePermission::ROLE_ID)
                ->constrained("$schema." . Role::TABLE, Role::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(RolePermission::PERMISSION_ID)
                ->constrained("$schema." . Permission::TABLE, Permission::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * Create the user permissions table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createUserPermissionTable(string $schema): void
    {
        Schema::create("$schema." . UserPermission::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(UserPermission::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserPermission::USER_ID)
                ->constrained("$schema." . User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(UserPermission::PERMISSION_ID)
                ->constrained("$schema." . Permission::TABLE, Permission::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * Create the user roles table.
     *
     * @param string $schema
     *
     * @return void
     */
    private function createUserRoleTable(string $schema): void
    {
        Schema::create("$schema." . UserRole::TABLE, function (Blueprint $blueprint) use ($schema)
        {
            $blueprint
                ->uuid(UserRole::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserRole::USER_ID)
                ->constrained("$schema." . User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(UserRole::ROLE_ID)
                ->constrained("$schema." . Role::TABLE, Role::ID)
                ->cascadeOnDelete();
        });
    }

    #endregion
};

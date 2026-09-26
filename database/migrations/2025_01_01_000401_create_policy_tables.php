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

#endregion

return new class() extends Migration
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable(Permission::TABLE))
        {
            $this->createPermissionsTable();
        }
        if (!Schema::hasTable(Role::TABLE))
        {
            $this->createRolesTable();
        }
        if (!Schema::hasTable(RolePermission::TABLE))
        {
            $this->createRolePermissionTable();
        }
        if (!Schema::hasTable(UserRole::TABLE))
        {
            $this->createUserRoleTable();
        }
        if (!Schema::hasTable(UserPermission::TABLE))
        {
            $this->createUserPermissionTable();
        }
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(UserPermission::TABLE);
        Schema::dropIfExists(UserRole::TABLE);
        Schema::dropIfExists(RolePermission::TABLE);
        Schema::dropIfExists(Role::TABLE);
        Schema::dropIfExists(Permission::TABLE);
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createPermissionsTable(): void
    {
        Schema::create(Permission::TABLE, function (Blueprint $blueprint)
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
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Permission::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Role::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createRolesTable(): void
    {
        Schema::create(Role::TABLE, function (Blueprint $blueprint)
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
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
            $blueprint
                ->timestamp(Role::UPDATED_AT)
                ->index();
            $blueprint
                ->foreignId(Role::UPDATED_BY)
                ->nullable()
                ->constrained(User::TABLE, User::ID)
                ->nullOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createRolePermissionTable(): void
    {
        Schema::create(RolePermission::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(RolePermission::UUID)
                ->primary();
            $blueprint
                ->foreignId(RolePermission::ROLE_ID)
                ->constrained(Role::TABLE, Role::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(RolePermission::PERMISSION_ID)
                ->constrained(Permission::TABLE, Permission::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createUserPermissionTable(): void
    {
        Schema::create(UserPermission::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(UserPermission::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserPermission::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(UserPermission::PERMISSION_ID)
                ->constrained(Permission::TABLE, Permission::ID)
                ->cascadeOnDelete();
        });
    }

    /**
     * @return void
     */
    private function createUserRoleTable(): void
    {
        Schema::create(UserRole::TABLE, function (Blueprint $blueprint)
        {
            $blueprint
                ->uuid(UserRole::UUID)
                ->primary();
            $blueprint
                ->foreignId(UserRole::USER_ID)
                ->constrained(User::TABLE, User::ID)
                ->cascadeOnDelete();
            $blueprint
                ->foreignId(UserRole::ROLE_ID)
                ->constrained(Role::TABLE, Role::ID)
                ->cascadeOnDelete();
        });
    }

    #endregion
};

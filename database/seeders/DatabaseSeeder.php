<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            EquipmentSeeder::class,
            ApprovalSeeder::class,
        ]);

        $permissions = Permission::pluck('id');
        $admin_role = Role::find(1);
        $admin_role->permissions()->attach($permissions);

        $user = User::find(1);
        $user->roles()->attach($admin_role);
    }
}

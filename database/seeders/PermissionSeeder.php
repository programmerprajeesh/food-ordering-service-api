<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);        

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create product');
        $role2->givePermissionTo('edit product');
        $role2->givePermissionTo('delete product');
        $role2->givePermissionTo('create category');
        $role2->givePermissionTo('edit category');
        $role2->givePermissionTo('delete category');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule;

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'test@foodservice.com',
            'password' => bcrypt('password@test'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@foodservice.com',
            'password' => bcrypt('password@admin'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@foodservice.com',
            'password' => bcrypt('password@superadmin'),
        ]);
        $user->assignRole($role3);
    }
}

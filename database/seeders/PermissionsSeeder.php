<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $permission_all = Permission::create(['name' => 'all']);
        $role_admin->givePermissionTo($permission_all);

        $role_editor = Role::create(['name' => 'editor']);
        $permission_edit = Permission::create(['name' => 'edit']);
        $role_editor->givePermissionTo($permission_edit);

        $role_guest = Role::create(['name' => 'guest']);
        $permission_guest = Permission::create(['name' => 'view']);
        $role_guest->givePermissionTo($permission_guest);
    }
}

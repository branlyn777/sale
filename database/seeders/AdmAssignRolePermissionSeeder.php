<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmAssignRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::find(1);
        $permissions = Permission::all();
        foreach($permissions as $p)
        {
            $role->givePermissionTo($p);
        }


        // Asignar Roles al Usuario 1
        $user = User::find(1);
        $role = Role::find(1);
        $user->assignRole($role);
        
        // Asignar Roles al Usuario 2
        $user = User::find(2);
        $role = Role::find(1);
        $user->assignRole($role);

        // Asignar Roles al Usuario 3
        $user = User::find(3);
        $role = Role::find(2);
        $user->assignRole($role);




    //     $role = Role::find(1);
    //     // Asignar permisos de editar usuarios
    //     $permission = Permission::find(1);
    //     $role->givePermissionTo($permission);
    //     $permission = Permission::find(2);
    //     $role->givePermissionTo($permission);
    }
}

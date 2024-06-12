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
        // Asignar Roles al Usuario
        $user = User::find(1);
        $role = Role::find(1);
        $user->assignRole($role);


        // Asignar permisos de editar usuarios
        $permission = Permission::find(1);
        $role->givePermissionTo($permission);
    }
}

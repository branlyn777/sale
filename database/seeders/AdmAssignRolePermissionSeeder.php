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
        // Assigning all permissions to the first role (Developer)
        $role = Role::find(1);
        // Search all permissions
        $permissions = Permission::all();
        // Assigning all permissions to the role
        foreach($permissions as $p)
        {
            $role->givePermissionTo($p);
        }
        // Assign the role to the first user (Branlyn)
        $user = User::find(1);
        $role = Role::find(1);
        $user->assignRole($role);




        
        // Assign the role to the second user (Leonardo)
        $user = User::find(2);
        $role = Role::find(1);
        $user->assignRole($role);
    }
}

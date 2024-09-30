<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ID = 1;
        Role::create([
            'name' => 'Developer',
            'guard_name' => 'web',
            'description' => 'Programador de la página'
        ]);
        // ID = 2;
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'description' => 'Control Total'
        ]);
    }
}

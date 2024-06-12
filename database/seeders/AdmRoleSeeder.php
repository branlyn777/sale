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
        Role::create([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'description' => 'Control Total'
        ]);
        Role::create([
            'name' => 'Basico',
            'guard_name' => 'web',
            'description' => 'Control Total'
        ]);
    }
}

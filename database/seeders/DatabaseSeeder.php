<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Administration */
        $this->call(AdmUserSeeder::class);
        $this->call(AdmPermissionSeeder::class);
        $this->call(AdmRoleSeeder::class);
        $this->call(AdmAssignRolePermissionSeeder::class);

        // SIS - PETROL
        // $this->call(SisCisternSeeder::class);
        // $this->call(SisDriverSeeder::class);
        $this->call(SisOwnerSeeder::class);
        // $this->call(SisRuatSeeder::class);

    }
}

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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdmUserSeeder::class);
        $this->call(InvCategorySeeder::class);
        $this->call(InvProductSeeder::class);
        $this->call(InvBranchSeeder::class);
        $this->call(InvWarehouseSeeder::class);
        $this->call(InvInventorySeeder::class);
        $this->call(AdmUserBranchSeeder::class);
        $this->call(AdmSupplierSeeder::class);
        $this->call(TxnCashRegisterSeeder::class);
        $this->call(TxnPaymensTypeSeeder::class);
        $this->call(AdmPermissionSeeder::class);
        $this->call(AdmRoleSeeder::class);
        $this->call(AdmAssignRolePermissionSeeder::class);

        // SIS - PETROL
        $this->call(SisCisternSeeder::class);
        $this->call(SisDriverSeeder::class);
        $this->call(SisOwnerSeeder::class);
        $this->call(SisRuatSeeder::class);

    }
}

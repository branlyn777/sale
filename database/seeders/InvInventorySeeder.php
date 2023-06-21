<?php

namespace Database\Seeders;

use App\Models\InvInventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvInventory::create([
            'quantity' => 5,
            'unit_cost' => 1200,
            'inv_warehouse_id' => 1,
            'inv_product_id' => 1,
        ]);
        InvInventory::create([
            'quantity' => 5,
            'unit_cost' => 1100,
            'inv_warehouse_id' => 1,
            'inv_product_id' => 1,
        ]);

        InvInventory::create([
            'quantity' => 7,
            'unit_cost' => 900,
            'inv_warehouse_id' => 1,
            'inv_product_id' => 2,
        ]);
    }
}

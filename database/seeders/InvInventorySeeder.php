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
        // InvInventory::create([
        //     'quantity' => 5,
        //     'cost' => 1000,
        //     'price' => 1200,
        //     'inv_warehouse_id' => 1,
        //     'inv_product_id' => 1,
        // ]);
        // InvInventory::create([
        //     'quantity' => 5,
        //     'cost' => 1100,
        //     'price' => 700,
        //     'inv_warehouse_id' => 1,
        //     'inv_product_id' => 1,
        // ]);

        // InvInventory::create([
        //     'quantity' => 7,
        //     'cost' => 900,
        //     'price' => 1000,
        //     'inv_warehouse_id' => 1,
        //     'inv_product_id' => 2,
        // ]);

        for ($i=1; $i < 10001; $i++)
        { 

            
            $numeroAleatorio = rand(1000, 10000);
            $numeroAleatorio2 = rand(1, 7);

            InvInventory::create([
                'quantity' => $numeroAleatorio,
                'cost' => 900 + $i,
                'price' => 1000 + $i,
                'inv_warehouse_id' => $numeroAleatorio2,
                'inv_product_id' => $i,
            ]);
        }

    }
}

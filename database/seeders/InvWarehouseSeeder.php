<?php

namespace Database\Seeders;

use App\Models\InvWarehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        InvWarehouse::create([
            'name_warehouse' => 'Tienda',
            'description' => 'Lugar donde se venden los productos',
            'inv_branch_id' => 1,
        ]);
        // 2
        InvWarehouse::create([
            'name_warehouse' => 'Depósito',
            'description' => 'Lugar destinado al almacenaje de productos',
            'inv_branch_id' => 1,
        ]);
        // 3
        InvWarehouse::create([
            'name_warehouse' => 'Devoluciones',
            'description' => 'Lugar destinado recibir los productos devueltos',
            'inv_branch_id' => 1,
        ]);


        // 4
        InvWarehouse::create([
            'name_warehouse' => 'Tienda',
            'description' => 'Lugar donde se venden los productos',
            'inv_branch_id' => 2,
        ]);
        // 5
        InvWarehouse::create([
            'name_warehouse' => 'Depósito 1',
            'description' => 'Lugar destinado a productos electrónicos',
            'inv_branch_id' => 2,
        ]);
        // 6
        InvWarehouse::create([
            'name_warehouse' => 'Depósito 2',
            'description' => 'Lugar destinado a productos alimenticios',
            'inv_branch_id' => 2,
        ]);

        
        // 7
        InvWarehouse::create([
            'name_warehouse' => 'Tienda',
            'description' => 'Lugar donde se venden los productos',
            'inv_branch_id' => 3,
        ]);
    }
}

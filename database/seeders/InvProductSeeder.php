<?php

namespace Database\Seeders;

use App\Models\InvProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvProduct::create([
            'name_product' => 'Huawei Y9 Prime 2019',
            'description' => 'Tamaño de la pantalla: 6.59 pulgadas
            Tipo de pantalla: TFT LCD (LTPS)
            Colores de pantalla: 16.7M
            Resolución de pantalla: 2340 x 1080
            Pantalla PPI: 391',
            'price' => 1700.00,
            'barcode' => 123456789,
            'minimum_stock' => 1,
            'inv_categorie_id' => '1'
        ]);
    }
}

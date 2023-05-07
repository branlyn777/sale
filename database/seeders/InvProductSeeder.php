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
            'description' => 'Tamaño de la pantalla: 6.59 pulgadas Tipo de pantalla: TFT LCD (LTPS) Colores de pantalla: 16.7M Resolución de pantalla: 2340 x 1080 Pantalla PPI: 391',
            'price' => 1700.00,
            'image' => 'Huawei Y9 Prime 2019.png',
            'barcode' => 123456789,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        InvProduct::create([
            'name_product' => 'Sony WH-XB910N',
            'description' => '
                Auriculares con cancelación de ruido extra graves, auriculares inalámbricos Bluetooth sobre la oreja con micrófono y control de voz Alexa, color negro
                Marca	Sony
                Nombre del modelo	Sony WH-XB910N EXTRA BASS
                Color	Negro -
                Factor de forma	Supraaurales
                Tecnología de conectividad	hdmi, HDMI, Bluetooth 5.2
            ',
            'price' => 1200.00,
            'image' => 'Sony WH-XB910N.png',
            'barcode' => 12345432,
            'minimum_stock' => 3,
            'inv_categorie_id' => '8'
        ]);
    }
}

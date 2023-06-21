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
            'barcode' => 12345431,
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
        InvProduct::create([
            'name_product' => 'Google Chromecast 4',
            'description' => '
            Imagen: 4K HDR a 60 fps con Dolby Vision, HDR10 y HDR10+.
            Sonido: Dolby Atmos, Dolby Digital y Dolby Digital Plus.
            Procesador: AMLogic con 4 núcleos Cortex-A55 a 1,9 GHz.
            Memoria RAM: 2 GB.
            Almacenamiento interno: 4 GB.
            Conectividad: WiFi 5 (ac) y Bluetooth.
            Puertos: USB-C para alimentación eléctrica.
            Sistema operativo: Google TV basado en Android TV 10.
            ',
            'price' => 350.00,
            'image' => 'Google Chromecast 4.png',
            'barcode' => 12345433,
            'minimum_stock' => 2,
            'inv_categorie_id' => '13'
        ]);
        InvProduct::create([
            'name_product' => 'Logitech G305',
            'description' => '
            Ratón Gaming Inalámbrico, Captor HERO 12K, 12,000 DPI, Ultra-ligero, Batería de 250h, 6 Botones Programables, Memoría Integrada, PC/Mac - Negro
            ',
            'price' => 200.00,
            'image' => 'Logitech G305.png',
            'barcode' => 12345434,
            'minimum_stock' => 2,
            'inv_categorie_id' => '11'
        ]);
        InvProduct::create([
            'name_product' => 'Logitech MK295',
            'description' => '
            Tecnología SilentTouch.
            Altura de teclado ajustable.
            Diseño resistente a salpicaduras.
            Tecnología inalámbrica de 2,4 GHz (10 metros)
            Nano receptor USB.
            Indicador luminoso de bloqueo de mayúsculas.
            Conmutador de encendido/apagado.
            2 baterías AAA (alcalinas)
            ',
            'price' => 250.00,
            'image' => 'Logitech MK295.png',
            'barcode' => 12345435,
            'minimum_stock' => 2,
            'inv_categorie_id' => '11'
        ]);
        InvProduct::create([
            'name_product' => 'Genius WideCam F100',
            'description' => '
            Foto de interpolación de 12 MP Micrófono estéreo integrado de alta sensibilidad. Grabación Full HD 1080p hasta 30 fps. Lente ultra gran angular de 120 grados. Cable USB de 4.9 ft.
            ',
            'price' => 170.00,
            'image' => 'Genius WideCam F100.png',
            'barcode' => 12345436,
            'minimum_stock' => 2,
            'inv_categorie_id' => '5'
        ]);
        InvProduct::create([
            'name_product' => 'SanDisk Ultra Flair 128 GB',
            'description' => '
            Hasta 15 veces más rápido que un USB 2.0 estándar
            Hasta 150 MB/s de velocidades de lectura
            Transfiere una película completa en menos de 30 segundos
            Mantén la privacidad de tus archivos privados con el software SanDisk SecureAccess (incluido)
            ',
            'price' => 90.00,
            'image' => 'SanDisk Ultra Flair 128 GB.png',
            'barcode' => 12345437,
            'minimum_stock' => 2,
            'inv_categorie_id' => '9'
        ]);
        InvProduct::create([
            'name_product' => 'Quick Charge 3.0 Ugreen',
            'description' => '
            Este cargador Quick Charge 3.0 Ugreen ofrece una potencia máxima de 18 W (5 V 3 A).
            Resulta hasta 4 veces más rápida que la carga convencional, si tu smartphone es compatible
            con Quick Charge 3.0 podrás cargar su batería hasta el 80 % en tan solo 35 minutos. Cuenta con
            una sola conexión pero a cambio es bastante compacto.
            ',
            'price' => 240.00,
            'image' => 'Quick Charge 3.0 Ugreen.png',
            'barcode' => 12345438,
            'minimum_stock' => 2,
            'inv_categorie_id' => '11'
        ]);
        InvProduct::create([
            'name_product' => 'Samsung Galaxy Tab S7+',
            'description' => '
            Pantalla de 11" 2.560 x 1.600 p QuadHD @ 120Hz  
            Procesador Qualcomm Snapdragon 865 Plus Octa-core (1 core x 3.2 GHz + 3 core x 2.4 GHz + 4 core x 1.8 GHz)
            Memoria RAM de 6GB
            Almacenamiento de 128GB / 256 GB
            Sistema de cuatro altavoces AKG y sonido Dolby Atmos
            Cámara trasera 13 MPx y frontal 8 MPx con grabación de video 4K
            Batería 8.000 mAh
            Wi-Fi a 2.4 GHz y 5 GHz, 4G LTE o 5G (opcional)
            INCLUYE: Lápiz táctil S-Pen
            ',
            'price' => 240.00,
            'image' => 'Samsung Galaxy Tab S7+.png',
            'barcode' => 12345439,
            'minimum_stock' => 2,
            'inv_categorie_id' => '2'
        ]);
    }
}

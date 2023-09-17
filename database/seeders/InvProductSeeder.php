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
        InvProduct::create([
            'name_product' => 'Nubia Z50 Ultra',
            'description' => '
            Pantalla: 6.8", 1116 x 2480 pixels
            Procesador: Snapdragon 8 Gen 2 3.2GHz
            RAM: 8GB/12GB/16GB
            Almacenamiento: 256GB/512GB/1TB
            Expansión: sin microSD
            Cámara: Triple, 64MP+50MP+64MP
            ',
            'price' => 7000.00,
            'image' => 'Nubia Z50 Ultra.png',
            'barcode' => 7456874,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        InvProduct::create([
            'name_product' => 'Sony Xperia M4 Aqua',
            'description' => '
            DIMENSIONES FÍSICAS	145,5 x 72,6 x 7,3 mm, 136 gramos
            PANTALLA	IPS 5 pulgadas
            RESOLUCIÓN	1280x720 píxeles (294 ppp)
            PROCESADOR	Snapdragon 615 8 núcleos (4 a 1,5 GHz y 4 a 1 GHz
            RAM	2 GB
            MEMORIA	8/16 GB (ampliable con tarjetas microSD de hasta 128 GB)
            VERSIÓN SOFTWARE	Android 5.0
            ',
            'price' => 1450.00,
            'image' => 'Sony Xperia M4 Aqua.png',
            'barcode' => 4564589,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        InvProduct::create([
            'name_product' => 'Xiaomi Poco F2 Pro',
            'description' => '
            Pantalla: 6.67", 1080 x 2400 pixels
            Procesador: Snapdragon 865 2.84GHz
            RAM: 6GB/8GB
            Almacenamiento: 128GB/256GB
            Expansión: sin microSD
            Cámara: Cuádruple, 64MP+5MP +13MP+2MP
            ',
            'price' => 3500.00,
            'image' => 'Xiaomi Poco F2 Pro.png',
            'barcode' => 78532645,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        InvProduct::create([
            'name_product' => 'OnePlus 7 Pro',
            'description' => '
            PANTALLA	6,67 pulgadas 1.440 x 3.120 px AMOLED
            90 Hz, 516 ppp
            PROCESADOR	Snapdragon 855
            MEMORIA RAM	12 GB
            ALMACENAMIENTO	256 GB UFS 3.0
            SISTEMA OPERATIVO	Android 9 Pie + OxygenOS
            CÁMARAS TRASERAS	48 Mpx f/1.6 OIS+EIS
            + 8 Mpx tele f/2.4 OIS
            + ultra gran angular f/2.2 117º
            ',
            'price' => 3700.00,
            'image' => 'OnePlus 7 Pro.png',
            'barcode' => 78474645,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        InvProduct::create([
            'name_product' => 'Xiaomi Mi 9T Pro',
            'description' => '
            PANTALLA
            AMOLED 6,39" FullHD+
            2.340 x 1.080 píxeles (403 ppp), 19,5:9
            PROCESADOR
            Snapdragon 855
            MEMORIA RAM
            6 GB
            ALMACENAMIENTO
            64/128 GB
            BATERÍA
            4.000 mAh + carga rápida 27 W
            CÁMARA TRASERA
            48 MP, f/1.75
            13 MP ultra gran angular, f/2.4
            8 MP, f/2.4, telefoto zoom 2x
            ',
            'price' => 3400.00,
            'image' => 'Xiaomi Mi 9T Pro.png',
            'barcode' => 71234645,
            'minimum_stock' => 2,
            'inv_categorie_id' => '1'
        ]);
        // for ($i=1; $i < 10001; $i++)
        // { 
        //     $numeroAleatorio = rand(1000, 10000);
        //     $numeroAleatorio2 = rand(1, 13);

        //     InvProduct::create([
        //             'name_product' => 'Producto ' . $i,
        //             'description' => '
        //             PANTALLA
        //             AMOLED 6,39" FullHD+
        //             2.340 x 1.080 píxeles (403 ppp), 19,5:9
        //             PROCESADOR
        //             Snapdragon 855
        //             MEMORIA RAM
        //             6 GB
        //             ALMACENAMIENTO
        //             64/128 GB
        //             BATERÍA
        //             4.000 mAh + carga rápida 27 W
        //             CÁMARA TRASERA
        //             48 MP, f/1.75
        //             13 MP ultra gran angular, f/2.4
        //             8 MP, f/2.4, telefoto zoom 2x
        //             ',
        //             'price' => 3400.00 + $i,
        //             'image' => 'Xiaomi Mi 9T Pro.png',
        //             'barcode' => $numeroAleatorio . $i,
        //             'minimum_stock' => 2,
        //             'inv_categorie_id' => $numeroAleatorio2
        //         ]);       
        // }
    }
}

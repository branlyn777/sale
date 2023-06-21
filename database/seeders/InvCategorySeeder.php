<?php

namespace Database\Seeders;

use App\Models\InvCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        InvCategory::create([
            'name_category' => 'Teléfonos móviles'
        ]);

        // 2
        InvCategory::create([
            'name_category' => 'Tabletas'
        ]);

        // 3
        InvCategory::create([
            'name_category' => 'Computadoras Portátiles'
        ]);

        // 4
        InvCategory::create([
            'name_category' => 'Computadoras de Escritorio'
        ]);

        // 5
        InvCategory::create([
            'name_category' => 'Cámaras Digitales'
        ]);

        // 6
        InvCategory::create([
            'name_category' => 'Televisores'
        ]);

        // 7
        InvCategory::create([
            'name_category' => 'Altavoces y Sistemas de Sonido'
        ]);

        // 8
        InvCategory::create([
            'name_category' => 'Auriculares y Audífonos'
        ]);

        // 9
        InvCategory::create([
            'name_category' => 'Dispositivos de Almacenamiento'
        ]);

        // 10
        InvCategory::create([
            'name_category' => 'Dispositivos de Red'
        ]);

        // 11
        InvCategory::create([
            'name_category' => 'Accesorios para Dispositivos Electrónicos'
        ]);
        
        // 12
        InvCategory::create([
            'name_category' => 'Juegos y Consolas de Videojuegos'
        ]);

        // 13
        InvCategory::create([
            'name_category' => 'Dispositivos de Streaming'
        ]);
    }
}

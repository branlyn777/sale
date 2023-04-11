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
        InvCategory::create([
            'name_category' => 'Teléfonos móviles'
        ]);
        InvCategory::create([
            'name_category' => 'Tabletas'
        ]);
        InvCategory::create([
            'name_category' => 'Computadoras Portátiles'
        ]);
        InvCategory::create([
            'name_category' => 'Computadoras de Escritorio'
        ]);
        InvCategory::create([
            'name_category' => 'Cámaras Digitales'
        ]);
        InvCategory::create([
            'name_category' => 'Televisores'
        ]);
        InvCategory::create([
            'name_category' => 'Altavoces y Sistemas de Sonido'
        ]);
        InvCategory::create([
            'name_category' => 'Auriculares y Audífonos'
        ]);
        InvCategory::create([
            'name_category' => 'Dispositivos de Almacenamiento'
        ]);
        InvCategory::create([
            'name_category' => 'Dispositivos de Red'
        ]);
        InvCategory::create([
            'name_category' => 'Accesorios para Dispositivos Electrónicos'
        ]);
        InvCategory::create([
            'name_category' => 'Juegos y Consolas de Videojuegos'
        ]);
    }
}

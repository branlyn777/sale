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
            'name' => 'Teléfonos móviles'
        ]);
        InvCategory::create([
            'name' => 'Tabletas'
        ]);
        InvCategory::create([
            'name' => 'Computadoras Portátiles'
        ]);
        InvCategory::create([
            'name' => 'Computadoras de Escritorio'
        ]);
        InvCategory::create([
            'name' => 'Cámaras Digitales'
        ]);
        InvCategory::create([
            'name' => 'Televisores'
        ]);
        InvCategory::create([
            'name' => 'Altavoces y Sistemas de Sonido'
        ]);
        InvCategory::create([
            'name' => 'Auriculares y Audífonos'
        ]);
        InvCategory::create([
            'name' => 'Dispositivos de Almacenamiento'
        ]);
        InvCategory::create([
            'name' => 'Dispositivos de Red'
        ]);
        InvCategory::create([
            'name' => 'Accesorios para Dispositivos Electrónicos'
        ]);
        InvCategory::create([
            'name' => 'Juegos y Consolas de Videojuegos'
        ]);
    }
}

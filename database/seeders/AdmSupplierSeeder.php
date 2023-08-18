<?php

namespace Database\Seeders;

use App\Models\AdmSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1
        AdmSupplier::create([
            'name_supplier' => 'Cancha',
            'address' => 'Av. San Martín y Uruguay',
            'phone_number_a' => '71787966',
            'phone_number_b' => '78451584',
            'mail' => 'cancha@gmail.com',
            'other_details' => 'No acepta pago por bancos (solo efectivo)'
        ]);

        // 2
        AdmSupplier::create([
            'name_supplier' => 'Soluciones Informáticas Emanuel',
            'address' => 'Av. América y Oquendo',
            'phone_number_a' => '78451697',
            'phone_number_b' => '75641385',
            'mail' => 'emanuel@gmail.com',
            'other_details' => ''
        ]);
    }
}

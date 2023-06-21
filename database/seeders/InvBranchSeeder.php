<?php

namespace Database\Seeders;

use App\Models\InvBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvBranch::create([
            'name_branch' => 'Sucursal Central',
            'direction' => 'Avenida Ayacucho y Jordán',
        ]);
        InvBranch::create([
            'name_branch' => 'Sucursal Norte',
            'direction' => 'Avenida América y Simón Bolivar',
        ]);
        InvBranch::create([
            'name_branch' => 'Sucursal Sur',
            'direction' => 'Avenida 6 de Agosto y Panamericana',
        ]);
    }
}

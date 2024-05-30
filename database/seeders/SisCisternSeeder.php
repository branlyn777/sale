<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SisCisternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++)
        {
            DB::table('sis_cisterns')->insert([
                'plate' => strtoupper(Str::random(7)),
                'chassis_number' => strtoupper(Str::random(17)),
                'engine' => strtoupper(Str::random(10)),
                'axle_model' => 'Model ' . rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

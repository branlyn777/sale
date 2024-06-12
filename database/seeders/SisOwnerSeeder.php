<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SisOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('sis_owners')->insert([
                'owner_code' => strtoupper(Str::random(7)),
                'name' => fake()->firstName,
                'paternal_surname' => fake()->lastName,
                'maternal_surname' => fake()->lastName,
                'ci_number' => strtoupper(Str::random(10)),
                'birthdate' => fake()->date,
                'nit_number' => strtoupper(Str::random(10)),
                'status' => fake()->randomElement(['active', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

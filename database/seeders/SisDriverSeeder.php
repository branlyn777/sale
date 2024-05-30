<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SisDriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('sis_drivers')->insert([
                'name' => $faker->name,
                'ci_number' => $faker->unique()->ssn,
                'license_number' => $faker->unique()->regexify('[A-Z0-9]{7}'),
                'start_date' => $faker->optional()->date(),
                'end_date' => $faker->optional()->date(),
                'cistern_id' => $faker->numberBetween(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\SisRuat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SisRuatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++)
        {
            SisRuat::create([
                'class' => $faker->unique()->lexify('Clase ???'),
                'mark' => $faker->company,
                'vehicle_type' => $faker->randomElement(['SUV', 'Sedan', 'Truck', 'Convertible']),
                'vehicle_subtype' => $faker->randomElement(['Compact', 'Full-Size', 'Mid-Size']),
                'engine_number' => $faker->unique()->numerify('##########'),
                'chassis_number' => $faker->numerify('##########'),
                'model' => $faker->year,
                'service' => $faker->randomElement(['Private', 'Public', 'Commercial']),
                'license_plate' => $faker->unique()->bothify('???-####'),
                'policy_type' => $faker->randomElement(['Comprehensive', 'Third Party', 'Fire and Theft']),
                'policy_date' => $faker->date,
                'country' => $faker->country,
                'customs_import' => $faker->randomElement(['Imported', 'Local']),
                'policy_number' => $faker->numerify('POL######'),
                'tax_start_year' => $faker->year,
                'origin' => $faker->country,
                'displacement' => $faker->randomFloat(2, 1.0, 5.0),
                'traction' => $faker->randomElement(['4WD', 'FWD', 'RWD']),
                'number_of_wheels' => $faker->numberBetween(2, 18),
                'number_of_doors' => $faker->numberBetween(2, 5),
                'color' => $faker->safeColorName,
                'number_of_places' => $faker->numberBetween(2, 8),
                'fuel' => $faker->randomElement(['Petrol', 'Diesel', 'Electric', 'Hybrid']),
                'bodywork_type' => $faker->randomElement(['Crossover', 'Hatchback', 'SUV']),
                'chassis_type' => $faker->randomElement(['Unibody', 'Body-on-Frame']),
                'motor_type' => $faker->randomElement(['Inline-4', 'V6', 'V8']),
                'motor_turbo' => $faker->boolean,
                'weight' => $faker->randomFloat(2, 500, 5000),
                'towing_capacity' => $faker->randomFloat(2, 1000, 10000),
                'observations' => $faker->sentence,
                'status' => $faker->randomElement(['active', 'inactive']),
            ]);
        }
    }
}

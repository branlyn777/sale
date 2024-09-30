<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Branlyn',
            'email' => 'branlyn777@gmail.com',
            'password' => bcrypt('3729')
        ]);
        User::create([
            'name' => 'Leonardo',
            'email' => 'leonardo@gmail.com',
            'password' => bcrypt('1234')
        ]);
    }
}

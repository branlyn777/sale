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
            'email' => 'branlyn@mail.com',
            'password' => bcrypt('1234')
        ]);
        User::create([
            'name' => 'Ana',
            'email' => 'ana@mail.com',
            'password' => bcrypt('1234')
        ]);
        User::create([
            'name' => 'Peter',
            'email' => 'peter@mail.com',
            'password' => bcrypt('1234')
        ]);
    }
}

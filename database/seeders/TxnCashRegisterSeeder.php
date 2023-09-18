<?php

namespace Database\Seeders;

use App\Models\TxnCashRegister;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TxnCashRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TxnCashRegister::create([
            'name_cash_register' => "Caja 1",
            'description' => "",
            'condition' => "close",
            'inv_branch_id' => 1,
        ]);
        TxnCashRegister::create([
            'name_cash_register' => "Caja A",
            'description' => "",
            'condition' => "close",
            'inv_branch_id' => 2,
        ]);
        TxnCashRegister::create([
            'name_cash_register' => "Caja Central",
            'description' => "",
            'condition' => "close",
            'inv_branch_id' => 3,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\TxnPaymentsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TxnPaymensTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TxnPaymentsType::create([
            'name_payment_type' => "Efectivo",
            'description' => "Dinero Fisico",
            'type' => "cash",
            'txn_cash_registers_id' => 1,
        ]);
        TxnPaymentsType::create([
            'name_payment_type' => "Efectivo",
            'description' => "Dinero Fisico",
            'type' => "cash",
            'txn_cash_registers_id' => 2,
        ]);
        TxnPaymentsType::create([
            'name_payment_type' => "Efectivo",
            'description' => "Dinero Fisico",
            'type' => "cash",
            'txn_cash_registers_id' => 3,
        ]);
    }
}

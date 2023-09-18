<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxnPaymentsType extends Model
{
    use HasFactory;
    protected $fillable = ['name_payment_type','description','type','status','txn_cash_registers_id'];
}

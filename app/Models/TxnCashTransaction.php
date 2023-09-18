<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxnCashTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['amount','type','status','txn_payments_type_id','txn_cash_register_id','user_id'];
}

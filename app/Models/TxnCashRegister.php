<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxnCashRegister extends Model
{
    use HasFactory;
    protected $fillable = ['name_cash_register','description','condition','status','inv_branch_id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invBuy extends Model
{
    use HasFactory;
    protected $fillable = ['total','items','observation','status','inv_branch_id','adm_supplier_id','user_id'];
}

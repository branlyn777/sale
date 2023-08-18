<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invBuyDetail extends Model
{
    use HasFactory;
    protected $fillable = ['cost','price','quantity','inv_product_id','inv_buy_id'];
}

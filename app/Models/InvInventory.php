<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvInventory extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','unit_cost','inv_warehouse_id','inv_product_id'];
}

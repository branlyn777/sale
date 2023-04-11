<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvProduct extends Model
{
    use HasFactory;
    protected $fillable = ['name_product','description','price','image','barcode','guarantee','minimum_stock','status','inv_categorie_id'];
}

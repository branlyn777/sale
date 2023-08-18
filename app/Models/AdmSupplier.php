<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmSupplier extends Model
{
    use HasFactory;
    protected $fillable = ['name_supplier','address','phone_number_a','phone_number_b','mail','other_details','status'];
}

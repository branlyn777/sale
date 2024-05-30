<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisCistern extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate',
        'chassis_number',
        'engine',
        'axle_model',
        'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisRuatOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'sis_owner_id',
        'sis_ruat_id'
    ];
}

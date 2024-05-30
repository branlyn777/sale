<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
        'ci_number',
        'license_number',
        'start_date',
        'end_date',
        'photo_path',
        'cistern_id',
        'status'
    ];
}

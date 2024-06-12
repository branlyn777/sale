<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisOwner extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_code',
        'name',
        'paternal_surname',
        'maternal_surname',
        'ci_number',
        'birthdate',
        'nit_number',
        'status'
    ];
}

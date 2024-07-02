<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisRuat extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_plate',
        'class',
        'mark',
        'vehicle_type',
        'vehicle_subtype',
        'engine_number',
        'chassis_number',
        'model',
        'service',
        'policy_type',
        'policy_date',
        'country',
        'customs_import',
        'policy_number',
        'tax_start_year',
        'origin',
        'displacement',
        'traction',
        'number_of_wheels',
        'number_of_doors',
        'color',
        'number_of_places',
        'fuel',
        'bodywork_type',
        'chassis_type',
        'motor_type',
        'motor_turbo',
        'weight',
        'towing_capacity',
        'observations',
        'status'
    ];
}

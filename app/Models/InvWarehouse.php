<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvWarehouse extends Model
{
    use HasFactory;
    protected $fillable = ['name_warehouse','description','status','branch_id'];
}

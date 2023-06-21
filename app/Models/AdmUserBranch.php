<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmUserBranch extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','inv_branch_id'];
}

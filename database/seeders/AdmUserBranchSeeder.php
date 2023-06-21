<?php

namespace Database\Seeders;

use App\Models\AdmUserBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmUserBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdmUserBranch::create([
            'user_id' => 1,
            'inv_branch_id' => 1,
        ]);
        AdmUserBranch::create([
            'user_id' => 2,
            'inv_branch_id' => 2,
        ]);
        AdmUserBranch::create([
            'user_id' => 2,
            'inv_branch_id' => 2,
        ]);
    }
}

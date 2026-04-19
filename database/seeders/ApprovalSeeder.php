<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RequiredApproval;

class ApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvals = [
            [
                'title' => 'Test 1', 
                'authority' => 'MEW',
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Test 2', 
                'authority' => 'MOI',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Test 3', 
                'authority' => 'MOI',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Test 4', 
                'authority' => 'Kuwait Municipality',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        RequiredApproval::insert($approvals);
    }
}

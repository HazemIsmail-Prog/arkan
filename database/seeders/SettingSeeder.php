<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = [
            'project_start_date' => '2026-01-01',
            'project_end_date' => '2026-12-31',
            'work_progress' => 0,
        ];
        Setting::insert($setting);
    }
}

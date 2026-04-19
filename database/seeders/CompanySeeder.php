<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name_ar' => 'أركان', 'name_en' => 'ARKAN', 'logo_path' => 'arkan-logo.jpeg'],
            ['name_ar' => 'بيس', 'name_en' => 'PACE', 'logo_path' => 'pace-logo.jpeg'],
            ['name_ar' => 'يوني بايلر', 'name_en' => 'UNIPILES', 'logo_path' => 'unipiles-logo.jpeg'],
        ];
        Company::insert($companies);
    }
}

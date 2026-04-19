<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipment = [
            [
                'name' => 'Equipment 1', 
                'type' => 'Pump',
                'location' => 'off_site',
            ],
            [
                'name' => 'Equipment 2', 
                'type' => 'Generator',
                'location' => 'off_site',
            ],
            [
                'name' => 'Equipment 3', 
                'type' => 'Truck',
                'location' => 'on_site',
            ],
            [
                'name' => 'Equipment 4', 
                'type' => 'Tower crane',
                'location' => 'on_site',
            ],
        ];
        Equipment::insert($equipment);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Hazem Ismail', 
                'email' => 'hazem@unipiles.com', 
                'password' => bcrypt('password'), 
                'company_id' => 3,
                'title' => 'Document Controller',
                'sort_order' => 7,
            ],
            [
                'name' => 'San Moussa', 
                'email' => 'san@unipiles.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 3,
                'title' => 'Project Manager',
                'sort_order' => 4,
            ],
            [
                'name' => 'Bahy Makki', 
                'email' => 'bahy@unipiles.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 3,
                'title' => 'Project Engineer',
                'sort_order' => 5,
            ],
            [
                'name' => 'Amir Naeem', 
                'email' => 'amir@unipiles.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 3,
                'title' => 'Project Supervisor',
                'sort_order' => 6,
            ],
            [
                'name' => 'Mahmoud Rashwan', 
                'email' => 'mahmoud@arkan.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 1,
                'title' => 'Project Manager',
                'sort_order' => 2,
            ],
            [
                'name' => 'Lulwa Al-Qaoud', 
                'email' => 'lulwa@arkan.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 1,
                'title' => 'Owner',
                'sort_order' => 1,
            ],
            [
                'name' => 'Ahmed Talib', 
                'email' => 'ahmed@pace.com', 
                'password' => bcrypt('123456'), 
                'company_id' => 2,
                'title' => 'Project Manager',
                'sort_order' => 3,
            ],
        ];
        User::insert($users);
    }
}

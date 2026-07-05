<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run(): void
    {
        Hostel::insert([
            [
                'name' => 'Block A',
                'gender' => 'Male',
                'capacity' => 100,
                'total_rooms' => 20,
                'location' => 'Main Campus',
                'description' => 'Male students hostel',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Block B',
                'gender' => 'Female',
                'capacity' => 100,
                'total_rooms' => 20,
                'location' => 'Main Campus',
                'description' => 'Female students hostel',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Block C',
                'gender' => 'Male',
                'capacity' => 60,
                'total_rooms' => 12,
                'location' => 'Annex Campus',
                'description' => 'Extension hostel',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

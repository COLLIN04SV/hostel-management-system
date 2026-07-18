<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hostel;

class HostelSeeder extends Seeder
{
    public function run(): void
    {
        $hostels = [];

        // 3 Male Hostels
        for ($i = 1; $i <= 3; $i++) {

            $hostels[] = [

                'name' => 'Male Hostel '.$i,

                'gender' => 'Male',

                'capacity' => 30,

                'total_rooms' => 15,

                'location' => 'Main Campus',

                'description' => 'Male students hostel '.$i,

                'status' => 1,

                'created_at' => now(),

                'updated_at' => now(),

            ];
        }

        // 3 Female Hostels
        for ($i = 1; $i <= 3; $i++) {

            $hostels[] = [

                'name' => 'Female Hostel '.$i,

                'gender' => 'Female',

                'capacity' => 30,

                'total_rooms' => 15,

                'location' => 'Main Campus',

                'description' => 'Female students hostel '.$i,

                'status' => 1,

                'created_at' => now(),

                'updated_at' => now(),

            ];
        }

        Hostel::insert($hostels);
    }
}
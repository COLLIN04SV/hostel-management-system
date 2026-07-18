<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hostel;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [];

        foreach (Hostel::all() as $hostel) {

            // Determine room prefix
            if ($hostel->gender == 'Male') {

                $prefix = 'MH'.$hostel->id;

                $price = 12000;

            } else {

                $prefix = 'FH'.($hostel->id - 3);

                $price = 12000;

            }

            for ($i = 1; $i <= 15; $i++) {

                $rooms[] = [

                    'hostel_id' => $hostel->id,

                    'room_number' => $prefix.'-'.str_pad($i, 3, '0', STR_PAD_LEFT),

                    'floor' => ceil($i / 5),

                    'capacity' => 2,

                    'occupied' => 0,

                    'price' => $price,

                    'status' => 1,

                    'created_at' => now(),

                    'updated_at' => now(),

                ];

            }
        }

        Room::insert($rooms);
    }
}
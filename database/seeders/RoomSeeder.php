<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [];

        // Hostel 1
        for ($i = 1; $i <= 20; $i++) {
            $rooms[] = [
                'hostel_id' => 1,
                'room_number' => 'A'.$i,
                'floor' => ceil($i / 10),
                'capacity' => 5,
                'occupied' => 0,
                'price' => 12000,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Hostel 2
        for ($i = 1; $i <= 20; $i++) {
            $rooms[] = [
                'hostel_id' => 2,
                'room_number' => 'B'.$i,
                'floor' => ceil($i / 10),
                'capacity' => 5,
                'occupied' => 0,
                'price' => 12000,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Hostel 3
        for ($i = 1; $i <= 12; $i++) {
            $rooms[] = [
                'hostel_id' => 3,
                'room_number' => 'C'.$i,
                'floor' => ceil($i / 6),
                'capacity' => 5,
                'occupied' => 0,
                'price' => 10000,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Room::insert($rooms);
    }
}
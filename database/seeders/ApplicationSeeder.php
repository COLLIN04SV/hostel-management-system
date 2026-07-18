<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Student;
use App\Models\Hostel;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $maleHostels = Hostel::where(
            'gender',
            'Male'
        )->pluck('id')->toArray();

        $femaleHostels = Hostel::where(
            'gender',
            'Female'
        )->pluck('id')->toArray();

        $applications = [];

        foreach (Student::all() as $student) {

            if ($student->gender == 'Male') {

                $hostelId = $maleHostels[array_rand($maleHostels)];

            } else {

                $hostelId = $femaleHostels[array_rand($femaleHostels)];

            }

            $applications[] = [

                'student_id' => $student->id,

                'hostel_id' => $hostelId,

                'application_date' => now()->subDays(rand(1,30)),

                'status' => 'Pending',

                'created_at' => now(),

                'updated_at' => now(),

            ];

        }

        Application::insert($applications);
    }
}
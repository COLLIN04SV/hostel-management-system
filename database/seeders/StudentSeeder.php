<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [

            'Computer Science',
            'Information Technology',
            'Business Administration',
            'Accounting',
            'Electrical Engineering',
            'Civil Engineering',
            'Mechanical Engineering',
            'Education',
            'Nursing',
            'Hospitality'

        ];

        $maleFirstNames = [

            'Brian',
            'Kevin',
            'Dennis',
            'Daniel',
            'Peter',
            'Samuel',
            'John',
            'James',
            'Victor',
            'David',
            'Mark',
            'Eric',
            'Kennedy',
            'George',
            'Allan',
            'Paul',
            'Clinton',
            'Steve',
            'Dennis',
            'Elvis'

        ];

        $femaleFirstNames = [

            'Mary',
            'Faith',
            'Grace',
            'Mercy',
            'Joy',
            'Ann',
            'Lucy',
            'Lydia',
            'Diana',
            'Sharon',
            'Esther',
            'Irene',
            'Janet',
            'Purity',
            'Brenda',
            'Caroline',
            'Naomi',
            'Judith',
            'Ruth',
            'Cynthia'

        ];

        $lastNames = [

            'Mwangi',
            'Otieno',
            'Kiptoo',
            'Wanjiru',
            'Kamau',
            'Mutiso',
            'Omondi',
            'Maina',
            'Kariuki',
            'Ndungu',
            'Musyoka',
            'Njoroge',
            'Kimani',
            'Barasa',
            'Were',
            'Muli',
            'Chebet',
            'Koech',
            'Cheruiyot',
            'Nyambura'

        ];

        for ($i = 1; $i <= 200; $i++) {

            $gender = $i <= 100 ? 'Male' : 'Female';

            if ($gender == 'Male') {

                $firstName = $maleFirstNames[array_rand($maleFirstNames)];

            } else {

                $firstName = $femaleFirstNames[array_rand($femaleFirstNames)];

            }

            $lastName = $lastNames[array_rand($lastNames)];

            $fullName = $firstName.' '.$lastName;

            $user = User::create([

                'name' => $fullName,

                'email' => 'student'.$i.'@hostel.com',

                'password' => Hash::make('password'),

                'role' => 'student',

            ]);

                Student::create([

                'user_id' => $user->id,

                'registration_number' => 'CST'.str_pad($i, 4, '0', STR_PAD_LEFT),

                'phone' => '07'.rand(10,99).rand(1000000,9999999),

                'gender' => $gender,

                'department' => $departments[array_rand($departments)],

                'year_of_study' => rand(1,4),

                'guardian_name' => 'Mr/Mrs '.$lastName,

                'guardian_phone' => '07'.rand(10,99).rand(1000000,9999999),

                'address' => 'P.O Box '.rand(100,9999).', Nairobi',

                'profile_photo' => null,

            ]);

        }

    }
}
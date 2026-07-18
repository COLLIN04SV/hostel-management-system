<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAccount;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [

            'M-Pesa',

            'Visa Card',

            'MasterCard',

            'Bank Transfer'

        ];

        foreach (StudentAccount::with('student')->get() as $account) {

            // Skip accounts that somehow have no student
            if (!$account->student) {
                continue;
            }

            // Decide payment status
            
            // 45% Fully Paid
            // 35% Partial Payment
            // 20% Pending
            //

            $chance = rand(1, 100);

            if ($chance <= 45) {

              // fully paid

                $amount = $account->room_fee;

                Payment::create([

                    'student_id' => $account->student_id,

                    'student_account_id' => $account->id,

                    'amount' => $amount,

                    'payment_method' => $methods[array_rand($methods)],

                    'transaction_reference' =>
                        'SIM-'.Str::upper(Str::random(10)),

                    'payment_date' => now()->subDays(rand(0, 30)),

                    'status' => 'Completed',

                ]);

                $account->update([

                    'amount_paid' => $amount,

                    'balance' => 0,

                    'status' => 'Completed',

                ]);

            } elseif ($chance <= 80) {

               //partial payment

                $amount = rand(

                    intval($account->room_fee * 0.30),

                    intval($account->room_fee * 0.80)

                );

                Payment::create([

                    'student_id' => $account->student_id,

                    'student_account_id' => $account->id,

                    'amount' => $amount,

                    'payment_method' => $methods[array_rand($methods)],

                    'transaction_reference' =>
                        'SIM-'.Str::upper(Str::random(10)),

                    'payment_date' => now()->subDays(rand(0, 30)),

                    'status' => 'Completed',

                ]);

                $account->update([

                    'amount_paid' => $amount,

                    'balance' => $account->room_fee - $amount,

                    'status' => 'Partial',

                ]);

            } else {

                // No payment

                $account->update([

                    'amount_paid' => 0,

                    'balance' => $account->room_fee,

                    'status' => 'Pending',

                ]);

            }
        }

        $this->command->info('==========================================');
        $this->command->info(' Payment seeding completed successfully.');
        $this->command->info('==========================================');

        $this->command->info('Student Accounts : '.StudentAccount::count());

        $this->command->info('Payments Created : '.Payment::count());

        $this->command->info(
            'Completed Accounts : '.
            StudentAccount::where('status','Completed')->count()
        );

        $this->command->info(
            'Partial Accounts : '.
            StudentAccount::where('status','Partial')->count()
        );

        $this->command->info(
            'Pending Accounts : '.
            StudentAccount::where('status','Pending')->count()
        );
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_accounts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('student_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('allocation_id')
                  ->constrained()
                  ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Financial Information
            |--------------------------------------------------------------------------
            */

            // Total room fee for the allocation
            $table->decimal('room_fee',10,2);

            // Money paid so far
            $table->decimal('amount_paid',10,2)->default(0);

            // Remaining balance
            $table->decimal('balance',10,2);

            $table->enum('status',[
                'Pending',
                'Partial',
                'Completed'
            ])->default('Pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
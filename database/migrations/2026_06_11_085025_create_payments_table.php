<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            // Student making the payment
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            // Account this payment belongs to
            $table->foreignId('student_account_id')
                ->constrained()
                ->cascadeOnDelete();

            // Amount paid in THIS transaction
            $table->decimal('amount', 10, 2);

            $table->string('payment_method');

            $table->string('transaction_reference')->nullable();

            $table->date('payment_date');

            $table->enum('status', [
                'Pending',
                'Completed'
            ])->default('Completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
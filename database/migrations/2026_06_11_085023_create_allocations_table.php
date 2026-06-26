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
        Schema::create('allocations', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_id')
          ->constrained()
          ->onDelete('cascade');

    $table->foreignId('room_id')
          ->constrained()
          ->onDelete('cascade');

    $table->date('allocated_date');

    $table->date('checkout_date')->nullable();

    $table->string('status')->default('Active');

    $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};

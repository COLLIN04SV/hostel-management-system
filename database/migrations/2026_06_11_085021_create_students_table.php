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
        Schema::create('students', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');

    $table->string('registration_number')->unique();

    $table->string('phone')->nullable();

    $table->enum('gender', ['Male', 'Female']);

    $table->string('department')->nullable();

    $table->string('year_of_study')->nullable();

    $table->string('guardian_name')->nullable();

    $table->string('guardian_phone')->nullable();

    $table->text('address')->nullable();

    $table->string('profile_photo')->nullable();

    $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

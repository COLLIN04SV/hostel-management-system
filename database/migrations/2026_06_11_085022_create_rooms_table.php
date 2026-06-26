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
        Schema::create('rooms', function (Blueprint $table) {
    $table->id();

    $table->foreignId('hostel_id')
          ->constrained()
          ->onDelete('cascade');

    $table->string('room_number');

    $table->integer('floor')->default(1);

    $table->integer('capacity');

    $table->integer('occupied')->default(0);

    $table->decimal('price', 10, 2)->default(0);

    $table->boolean('status')->default(true);

    $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

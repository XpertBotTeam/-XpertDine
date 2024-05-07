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
        Schema::create('guest_houses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Facilities')->nullable();
            $table->string('images')->nullable();
            $table->float('prices')->nullable();
            $table->string('location')->nullable();
            $table->string('Phonenumber')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['available', 'fully_booked'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_houses');
    }
};

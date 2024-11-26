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
        Schema::create('flight_lists', function (Blueprint $table) {
            $table->id();
            $table->string('flight_code');
            $table->string('departure_city');
            $table->string('departure_cityName');
            $table->string('arrival_city');
            $table->string('arrival_cityName');
            $table->string('departure_time');
            $table->string('arrival_time');
            $table->string('time');
            $table->string('flight_date');
            $table->string('airline');
            $table->string('flight_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_lists');
    }
};

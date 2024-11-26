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
        Schema::create('flight_chair_lists', function (Blueprint $table) {
            $table->string('flight_code');
            $table->string('ticket_type');
            $table->string('chair_number');
            $table->string('price_adult');
            $table->string('price_child');
            $table->string('price_infant');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_chair_lists');
    }
};

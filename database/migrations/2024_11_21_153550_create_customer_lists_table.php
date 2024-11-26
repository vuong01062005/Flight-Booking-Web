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
        Schema::create('customer_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('id_contact');
            $table->string('customer_type');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('birthday');
            $table->string('flight_code');
            $table->string('chair_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_lists');
    }
};

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
        Schema::create('account_user', function (Blueprint $table) {
           $table->id();
           $table->string('userName')->unique();
           $table->string('firstName')->unique();
           $table->string('lastName')->unique();
           $table->string('Email')->unique();
           $table->string('Phone')->unique();
           $table->string('BirthDay')->nullable();
           $table->string('Avarta')->unique();
           $table->string('password');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_user');
    }
};

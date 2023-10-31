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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Address')->nullable();
            $table->string('Contact')->nullable();
            $table->string('Email')->nullable();
            $table->string('Disc')->nullable();
            $table->string('Opening_Bal')->nullable();
            $table->string('Area_ID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};

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
        Schema::create('sis_cisterns', function (Blueprint $table) {
            $table->id();

            $table->string('plate')->unique();
            $table->string('chassis_number')->unique();
            $table->string('engine');
            $table->string('axle_model');
            $table->enum('status',['active','inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_cisterns');
    }
};

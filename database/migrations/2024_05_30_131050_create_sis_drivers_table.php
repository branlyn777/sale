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
        Schema::create('sis_drivers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('paternal_surname')->nullable();
            $table->string('maternal_surname')->nullable();
            $table->string('ci_number')->unique()->nullable();
            $table->string('license_number')->unique()->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->foreignId('cistern_id')->constrained('sis_cisterns');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_drivers');
    }
};

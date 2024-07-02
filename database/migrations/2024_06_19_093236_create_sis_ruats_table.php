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
        Schema::create('sis_ruats', function (Blueprint $table) {
            $table->id();

            $table->string('license_plate')->unique();
    
            $table->string('class')->unique();
            $table->string('mark');
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_subtype')->nullable();
            $table->string('engine_number')->unique();
            $table->string('chassis_number')->nullable();
            $table->string('model')->nullable();
            $table->string('service')->nullable();
    
            $table->string('policy_type')->nullable();
            $table->date('policy_date')->unique();
            $table->string('country')->nullable();
            $table->string('customs_import')->nullable();
            $table->string('policy_number')->nullable();
            $table->year('tax_start_year')->nullable();
            $table->string('origin')->nullable();
    
            $table->decimal('displacement', 8, 2)->nullable();
            $table->string('traction')->nullable();
            $table->integer('number_of_wheels')->nullable();
            $table->integer('number_of_doors')->nullable();
            $table->string('color')->nullable();
            $table->integer('number_of_places')->nullable();
            $table->string('fuel')->nullable();
            $table->string('bodywork_type')->nullable();
            $table->string('chassis_type')->nullable();
            $table->string('motor_type')->nullable();
            $table->boolean('motor_turbo')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('towing_capacity', 8, 2)->nullable();
    
            $table->text('observations')->nullable();
    
            $table->enum('status',['active','inactive'])->default('active');
    
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_ruats');
    }
};

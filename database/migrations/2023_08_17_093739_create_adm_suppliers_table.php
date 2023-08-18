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
        Schema::create('adm_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_supplier', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone_number_a', 100)->nullable();
            $table->string('phone_number_b', 100)->nullable();
            $table->string('mail', 100)->nullable();
            $table->text('other_details')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_suppliers');
    }
};

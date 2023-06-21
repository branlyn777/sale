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
        Schema::create('inv_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name_warehouse',255);
            $table->text('description')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreignId('inv_branch_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_warehouses');
    }
};

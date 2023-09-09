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
        Schema::create('inv_buys', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 12,2);
            $table->integer('items');
            $table->text('observation')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreignId('inv_branch_id')->constrained();
            $table->foreignId('adm_supplier_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_buys');
    }
};

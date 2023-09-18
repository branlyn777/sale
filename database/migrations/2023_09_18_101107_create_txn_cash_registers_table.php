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
        Schema::create('txn_cash_registers', function (Blueprint $table) {
            $table->id();
            $table->string('name_cash_register', 255);
            $table->text('description')->nullable();
            $table->enum('condition', ['open','close'])->default('close');
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
        Schema::dropIfExists('txn_cash_registers');
    }
};

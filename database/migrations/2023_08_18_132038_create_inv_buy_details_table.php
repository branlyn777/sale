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
        Schema::create('inv_buy_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost',10,2);
            $table->decimal('price',10,2);
            $table->integer('quantity');
            $table->foreignId('inv_product_id')->constrained();
            $table->foreignId('inv_buy_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_buy_details');
    }
};

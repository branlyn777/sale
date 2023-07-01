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
        Schema::create('inv_inventories', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('quantity'); //-32768 and 32767
            $table->decimal('cost', 8, 2)->default(0.00);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreignId('inv_warehouse_id')->constrained();
            $table->foreignId('inv_product_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_inventories');
    }
};

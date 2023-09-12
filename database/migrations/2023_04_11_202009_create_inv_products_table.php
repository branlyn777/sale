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
        Schema::create('inv_products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product',255)->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('image', 100)->nullable();
            $table->string('barcode', 50)->nullable()->unique();
            $table->smallInteger('guarantee')->nullable(); //-32768 and 32767
            $table->smallInteger('minimum_stock')->nullable(); // -32768 and 32767
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreignId('inv_categorie_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_products');
    }
};
